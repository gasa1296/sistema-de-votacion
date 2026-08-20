<?php

namespace App\Jobs;

use App\Mail\VoterCredentialsMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendVoterCredentialsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly User $voter,
    ) {}

    public function handle(): void
    {
        $plainPassword = Str::password(symbols: false);
        $hashedPassword = Hash::make($plainPassword);
        $this->voter->update(['password' => $hashedPassword]);

        Mail::to($this->voter->email)->queue(
            new VoterCredentialsMail($this->voter, $plainPassword)
        );
    }
}
