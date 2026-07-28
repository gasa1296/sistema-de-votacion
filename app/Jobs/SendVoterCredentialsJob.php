<?php

namespace App\Jobs;

use App\Mail\VoterCredentialsMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVoterCredentialsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly User $voter,
        private readonly string $plainPassword,
    ) {}

    public function handle(): void
    {
        Mail::to($this->voter->email)->queue(
            new VoterCredentialsMail($this->voter, $this->plainPassword)
        );
    }
}
