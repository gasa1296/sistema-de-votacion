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
        $electionName = $this->voter->elections()->first()?->name ?? config('app.name');

        return new Envelope(
            subject: 'Tus credenciales de votación — '.$electionName,
        );
    }

    public function content(): Content
    {
        $electionName = $this->voter->elections()->first()?->name ?? config('app.name');

        return new Content(
            view: 'emails.voter-credentials',
            with: [
                'logoSrc' => asset(config('app.logo')),
                'fullName' => trim($this->voter->name.' '.$this->voter->last_name),
                'email' => $this->voter->email,
                'password' => $this->plainPassword,
                'electionName' => $electionName,
                'loginUrl' => url('/login'),
                'supportEmail' => config('mail.from.address'),
                'domainName' => config('app.name')
            ],
        );
    }
}
