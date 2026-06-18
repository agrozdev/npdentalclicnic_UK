<?php

namespace App\Mail;

use App\Models\ChatLead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewChatLead extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly ChatLead $lead,
        public readonly array $messages,
        public readonly string $aiReply,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New chat enquiry — NP Dental Clinic',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-chat-lead',
        );
    }
}
