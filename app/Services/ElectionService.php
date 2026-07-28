<?php

namespace App\Services;

use App\Events\VoteCast;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;

class ElectionService
{
    public function open(Election $election): void
    {
        $election->update([
            'status' => 'open',
            'opens_at' => now(),
        ]);
    }

    public function close(Election $election): void
    {
        $election->update([
            'status' => 'closed',
            'closes_at' => now(),
        ]);
    }

    public function results(Election $election): array
    {
        $candidates = $election->candidates()
            ->withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        $totalVotes = $candidates->sum('votes_count');

        return $candidates->map(fn (Candidate $candidate) => [
            'id' => $candidate->id,
            'name' => $candidate->name.' '.($candidate->last_name ?? ''),
            'position' => $candidate->position,
            'photo_path' => $candidate->photo_path,
            'votes' => $candidate->votes_count,
            'percentage' => $totalVotes > 0
                ? round(($candidate->votes_count / $totalVotes) * 100, 1)
                : 0,
        ])->toArray();
    }

    public function hasUserVoted(User $user, Election $election): bool
    {
        return $election->users()
            ->where('user_id', $user->id)
            ->where('has_voted', true)
            ->exists();
    }

    public function cast(User $user, Candidate $candidate, ?string $ip = null, ?string $userAgent = null): Vote
    {
        return DB::transaction(function () use ($user, $candidate, $ip, $userAgent) {
            $user = User::lockForUpdate()->find($user->id);

            $vote = Vote::create([
                'election_id' => $candidate->election_id,
                'candidate_id' => $candidate->id,
                'ip_hash' => $ip ? hash_hmac('sha256', $ip, config('app.key')) : null,
                'user_agent_hash' => $userAgent ? hash_hmac('sha256', $userAgent, config('app.key')) : null,
                'voted_at' => now(),
            ]);

            $user->elections()->updateExistingPivot($candidate->election_id, [
                'has_voted' => true,
                'voted_at' => now(),
            ]);

            VoteCast::dispatch($vote);

            return $vote;
        });
    }
}
