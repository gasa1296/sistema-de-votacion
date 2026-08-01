<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VoteConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User $voter,
        public readonly Vote $vote,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Voto registrado — '.$this->vote->election->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.vote-confirmation',
            with: [
                'name' => $this->voter->name,
                'lastName' => $this->voter->last_name,
                'electionName' => $this->vote->election->name,
                'candidateName' => $this->vote->candidate->name.' '.($this->vote->candidate->last_name ?? ''),
                'position' => $this->vote->candidate->position,
                'votedAt' => $this->vote->voted_at->format('d/m/Y H:i'),
            ],
        );
    }
}
