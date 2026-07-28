<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VoterCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User $voter,
        public readonly string $plainPassword,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tus credenciales de votación — '.$this->voter->election->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.voter-credentials',
            with: [
                'name' => $this->voter->name,
                'lastName' => $this->voter->last_name,
                'email' => $this->voter->email,
                'password' => $this->plainPassword,
                'voterCode' => $this->voter->voter_code,
                'electionName' => $this->voter->election->name,
            ],
        );
    }
}
