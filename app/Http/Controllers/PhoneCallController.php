<?php

namespace App\Http\Controllers;

use App\Mail\NewPhoneCall;
use App\Mail\NewPhoneLead;
use App\Models\PhoneLead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PhoneCallController extends Controller
{
    public function webhook(Request $request): JsonResponse
    {
        $payload = $request->json()->all();

        // Debug — log every incoming VAPI payload before any processing
        Log::info('VAPI webhook received', [
            'type'    => data_get($payload, 'message.type', 'unknown'),
            'payload' => $payload,
        ]);

        $type = data_get($payload, 'message.type');

        return match ($type) {
            'tool-calls'         => $this->handleToolCall($payload),
            'end-of-call-report' => $this->handleEndOfCall($payload),
            default              => response()->json(['ok' => true]),
        };
    }

    private function handleToolCall(array $payload): JsonResponse
    {
        $toolCalls = data_get($payload, 'message.toolCallList', []);

        foreach ($toolCalls as $toolCall) {
            $name = data_get($toolCall, 'function.name');

            if ($name === 'submit_lead') {
                $args = data_get($toolCall, 'function.arguments', []);

                $lead = [
                    'caller_number'  => data_get($payload, 'message.call.customer.number', 'Unknown'),
                    'name'           => data_get($args, 'caller_name', ''),
                    'callback_number'=> data_get($args, 'callback_number', ''),
                    'email'          => data_get($args, 'email', ''),
                    'reason'         => data_get($args, 'reason', ''),
                    'preferred_time' => data_get($args, 'preferred_time', ''),
                ];

                // Save/update the phone lead record
                $record = PhoneLead::updateOrCreate(
                    ['vapi_call_id' => data_get($payload, 'message.call.id')],
                    [
                        'caller_number'  => $lead['caller_number'],
                        'name'           => $lead['name'] ?: null,
                        'email'          => $lead['email'] ?: null,
                        'reason'         => $lead['reason'] ?: null,
                        'preferred_time' => $lead['preferred_time'] ?: null,
                    ]
                );

                try {
                    Mail::to('atanasgrozdev@yahoo.com')
                        ->cc('info@npdentalclinic.com')
                        ->send(new NewPhoneLead($lead, $record));
                } catch (\Throwable $e) {
                    Log::error('Phone lead email failed: ' . $e->getMessage(), [
                        'trace' => $e->getTraceAsString(),
                    ]);
                }
            }
        }

        return response()->json([
            'results' => collect(data_get($payload, 'message.toolCallList', []))->map(fn ($tc) => [
                'toolCallId' => data_get($tc, 'id'),
                'result'     => 'Lead submitted successfully. The team will be in touch.',
            ])->values()->all(),
        ]);
    }

    private function handleEndOfCall(array $payload): JsonResponse
    {
        $call     = data_get($payload, 'message.call', []);
        $artifact = data_get($payload, 'message.artifact', []);
        $analysis = data_get($payload, 'message.analysis', []);

        // Save/update the phone lead record with full call data
        $record = PhoneLead::updateOrCreate(
            ['vapi_call_id' => data_get($call, 'id')],
            [
                'caller_number'  => data_get($call, 'customer.number'),
                'recording_url'  => data_get($artifact, 'recordingUrl'),
                'transcript'     => data_get($artifact, 'transcript'),
                'messages'       => data_get($artifact, 'messages', []),
                'summary'        => data_get($analysis, 'summary'),
                'ended_reason'   => data_get($payload, 'message.endedReason'),
                'call_started_at'=> data_get($call, 'startedAt'),
                'call_ended_at'  => data_get($call, 'endedAt'),
            ]
        );

        $callData = [
            'id'            => data_get($call, 'id', 'N/A'),
            'caller_number' => data_get($call, 'customer.number', 'Unknown'),
            'started_at'    => data_get($call, 'startedAt'),
            'ended_at'      => data_get($call, 'endedAt'),
            'ended_reason'  => data_get($payload, 'message.endedReason', 'N/A'),
            'recording_url' => data_get($artifact, 'recordingUrl'),
            'transcript'    => data_get($artifact, 'transcript', ''),
            'messages'      => data_get($artifact, 'messages', []),
            'summary'       => data_get($analysis, 'summary', ''),
        ];

        try {
            Mail::to('atanasgrozdev@yahoo.com')
                ->cc('info@npdentalclinic.com')
                ->send(new NewPhoneCall($callData, $record));
        } catch (\Throwable $e) {
            Log::error('Phone call email failed: ' . $e->getMessage(), [
                'call_id' => $callData['id'],
                'trace'   => $e->getTraceAsString(),
            ]);
        }

        return response()->json(['ok' => true]);
    }
}
