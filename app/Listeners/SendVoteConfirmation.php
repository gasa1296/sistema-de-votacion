<?php

namespace App\Listeners;

use App\Events\VoteCast;
use App\Mail\VoteConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Support\Facades\Mail;

class SendVoteConfirmation implements ShouldQueueAfterCommit
{
    public function handle(VoteCast $event): void
    {
        Mail::to($event->user->email)->queue(
            new VoteConfirmationMail($event->user, $event->vote)
        );
    }
}
