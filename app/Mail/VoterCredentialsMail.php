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
                'name' => $this->voter->name,
                'lastName' => $this->voter->last_name,
                'email' => $this->voter->email,
                'password' => $this->plainPassword,
                'voterCode' => $this->voter->voter_code,
                'electionName' => $electionName,
                'loginUrl' => url('/login'),
                'supportEmail' => 'notificaciones@votacionancam.com',
            ],
        );
    }
}
