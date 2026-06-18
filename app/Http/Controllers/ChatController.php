<?php

namespace App\Http\Controllers;

use App\Mail\NewChatLead;
use App\Models\ChatLead;
use App\Models\ChatMessage;
use App\Services\KnowledgeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    public function handle(Request $request, KnowledgeService $knowledge): JsonResponse
    {
        $request->validate([
            'session_token'    => ['required', 'uuid'],
            'messages'         => ['required', 'array', 'min:1'],
            'messages.*.role'  => ['required', 'in:user,assistant'],
            'messages.*.content' => ['required', 'string'],
            'name'             => ['sometimes', 'nullable', 'string', 'max:255'],
            'phone'            => ['sometimes', 'nullable', 'string', 'max:50'],
            'email'            => ['sometimes', 'nullable', 'email', 'max:255'],
        ]);

        $messages      = $request->input('messages');
        $sessionToken  = $request->input('session_token');
        $lastUserMsg   = collect($messages)->last(fn ($m) => $m['role'] === 'user')['content'] ?? '';

        $isNewLead = ! ChatLead::where('session_token', $sessionToken)->exists();

        $lead = $this->resolveLead($request, $sessionToken, $lastUserMsg);

        $kbContext    = $knowledge->findRelevant($lastUserMsg);
        $systemPrompt = $this->buildSystemPrompt($kbContext);

        $response = Http::withHeaders([
            'x-api-key'         => config('services.anthropic.key'),
            'anthropic-version' => '2023-06-01',
        ])->post('https://api.anthropic.com/v1/messages', [
            'model'      => 'claude-sonnet-4-6',
            'max_tokens' => 1024,
            'system'     => $systemPrompt,
            'messages'   => $messages,
        ]);

        $raw = $response->json('content.0.text', '');

        $suggestWhatsapp = str_contains($raw, '[WHATSAPP]');
        $aiMessage       = trim(str_replace('[WHATSAPP]', '', $raw));

        if (! $aiMessage) {
            $aiMessage = 'Sorry, I could not process your request.';
        }

        ChatMessage::create(['lead_id' => $lead->id, 'role' => 'user',      'content' => $lastUserMsg]);
        ChatMessage::create(['lead_id' => $lead->id, 'role' => 'assistant', 'content' => $aiMessage]);

        if ($isNewLead && ! $this->isSpam($lastUserMsg)) {
            Mail::to('atanasgrozdev@yahoo.com')->send(new NewChatLead($lead, $aiMessage));
        }

        return response()->json([
            'message'          => $aiMessage,
            'suggest_whatsapp' => $suggestWhatsapp,
        ]);
    }

    private function isSpam(string $message): bool
    {
        $clean = trim($message);

        // Too short to be a real enquiry
        if (mb_strlen($clean) < 10) {
            return true;
        }

        // Common test / throwaway phrases
        $spamPatterns = [
            '/^(test|testing|hi|hey|hello|helo|hola|yo|sup|check|asdf|qwerty|aaa+|bbb+|123+|xxx+)[\s!?.]*$/i',
            '/^[^a-z\p{L}]+$/iu', // only symbols / numbers, no real letters
        ];

        foreach ($spamPatterns as $pattern) {
            if (preg_match($pattern, $clean)) {
                return true;
            }
        }

        // High ratio of non-letter characters suggests gibberish
        $letterCount = preg_match_all('/\p{L}/u', $clean);
        if ($letterCount / mb_strlen($clean) < 0.4) {
            return true;
        }

        return false;
    }

    private function resolveLead(Request $request, string $token, string $firstMessage): ChatLead
    {
        $lead = ChatLead::firstOrNew(['session_token' => $token]);

        if (! $lead->exists) {
            $lead->source        = 'chat';
            $lead->first_message = mb_substr($firstMessage, 0, 1000);
            $lead->status        = 'new';
        }

        if ($request->filled('name'))  $lead->name  = $request->input('name');
        if ($request->filled('phone')) $lead->phone = $request->input('phone');
        if ($request->filled('email')) $lead->email = $request->input('email');

        $lead->save();

        return $lead;
    }

    private function buildSystemPrompt(string $kbContext): string
    {
        $prompt = <<<'PROMPT'
You are a helpful assistant for NP Dental Clinic (npdentalclinic.co.uk).
Always answer in the same language the client uses (English or Bulgarian).
Be warm, professional and concise.
IMPORTANT: Reply in plain text only. Do not use markdown, asterisks, bold, headers, bullet symbols, or any formatting characters.
IMPORTANT: Keep answers short and directly matched to what was asked. If someone asks whether a service exists, confirm yes or no in one sentence and add one key detail at most. Do not volunteer prices, procedures, travel info, or doctor names unless the patient specifically asks about those things. Only expand when the patient asks a follow-up. Always add [WHATSAPP] on a new line at the very end of your response in these specific situations: the patient asks how to book an appointment, wants to schedule a visit, asks about availability, needs an exact personalised price quote, has a dental emergency, or asks something you have absolutely no information about. Do NOT add [WHATSAPP] for general service questions. Never add [WHATSAPP] more than once per response.

Clinic info:
- Name: NP Dental Clinic
- Address: Akademik Yordan Trifonov 6A, entrance B, ground floor, Sofia, Bulgaria
- Phone/WhatsApp: +359 887 570020
- WhatsApp link: wa.me/359887570020
- Email: info@npdentalclinic.com
- Hours: Monday to Sunday, 08:00 - 20:00
- Lead dentist: Dr. Pavlina Kichukova, 15+ years experience
- Oral surgery specialist: Dr. Ali Atip (implants, extractions, surgical procedures)
- Services: dental implants (Swiss, crown included), zirconia veneers/crowns, clear aligners, whitening, laser dentistry, oral surgery, pediatric dentistry, prosthetics, general dentistry

Travel package (international patients):
- For implants: patients need 2-3 separate trips to Bulgaria. Trip 1 = implant placement; Trip 2 = crown measurements (after 3-4 months healing); Trip 3 = crown fitting and completion.
- For other treatments (veneers, crowns, whitening, orthodontics): typically completable in one trip over consecutive days.
- On every trip: hotel accommodation fully covered by the clinic, complimentary airport-to-hotel transfer, appointments scheduled around the patient's flight times.
- The patient only pays for their own plane tickets — the clinic handles everything else.

Use the KNOWLEDGE BASE section below to give accurate answers. When the knowledge base contains specific step-by-step information, always include those exact steps in your answer — do not paraphrase or omit them.
If a topic is not covered at all in the knowledge base, give a helpful general answer if possible, and only add [WHATSAPP] if you truly cannot help further.
PROMPT;

        if ($kbContext) {
            $prompt .= "\n\n" . $kbContext;
        }

        return $prompt;
    }
}
