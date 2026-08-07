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

    public function turnout(Election $election): array
    {
        $totalVoters = $election->users()->count();
        $totalVotes = $election->votes()->count();

        return [
            'total_voters' => $totalVoters,
            'total_votes' => $totalVotes,
            'percentage' => $totalVoters > 0
                ? round(($totalVotes / $totalVoters) * 100, 1)
                : 0,
        ];
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

    public function cast(User $user, ?Candidate $candidate, Election $election, ?string $ip = null, ?string $userAgent = null): Vote
    {
        return DB::transaction(function () use ($user, $candidate, $election, $ip, $userAgent) {
            $user = User::lockForUpdate()->find($user->id);

            if (! $user->elections()->where('election_id', $election->id)->exists()) {
                throw new \RuntimeException('Usuario no está asignado a esta elección.');
            }

            if ($user->elections()->where('election_id', $election->id)->where('has_voted', true)->exists()) {
                throw new \RuntimeException('Usuario ya ha votado en esta elección.');
            }
            $vote = Vote::create([
                'election_id' => $election->id,
                'candidate_id' => $candidate?->id,
                'ip_hash' => $ip ? hash_hmac('sha256', $ip, config('app.key')) : null,
                'user_agent_hash' => $userAgent ? hash_hmac('sha256', $userAgent, config('app.key')) : null,
                'voted_at' => now(),
            ]);

            $user->elections()->syncWithoutDetaching([$election->id => ['has_voted' => true, 'voted_at' => now()]]);

            VoteCast::dispatch($vote, $user);

            return $vote;
        });
    }
}
