<?php

namespace App\Listeners;

use App\Events\VoteCast;
use Illuminate\Support\Facades\Log;

class LogVoteCast
{
    public function handle(VoteCast $event): void
    {
        $vote = $event->vote;

        Log::channel('audit')->info('vote.cast', [
            'vote_id' => $vote->id,
            'election_id' => $vote->election_id,
            'candidate_id' => $vote->candidate_id,
            'ip_hash' => $vote->ip_hash,
            'user_agent_hash' => $vote->user_agent_hash,
            'voted_at' => $vote->voted_at?->toIso8601String(),
        ]);
    }
}
