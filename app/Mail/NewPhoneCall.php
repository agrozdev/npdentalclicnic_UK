<?php

namespace App\Mail;

use App\Models\PhoneLead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPhoneCall extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly array $callData,
        public readonly PhoneLead $record,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Phone Call — NP Dental Clinic',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-phone-call',
        );
    }
}
