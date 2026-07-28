<?php

use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use App\Services\ElectionService;

it('opens an election', function () {
    $election = Election::factory()->pending()->create();
    $service = app(ElectionService::class);

    $service->open($election);

    $election->refresh();
    expect($election->status)->toBe('open');
    expect($election->opens_at)->not->toBeNull();
});

it('closes an election', function () {
    $election = Election::factory()->open()->create();
    $service = app(ElectionService::class);

    $service->close($election);

    $election->refresh();
    expect($election->status)->toBe('closed');
    expect($election->closes_at)->not->toBeNull();
});

it('checks if user has voted', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $service = app(ElectionService::class);

    expect($service->hasUserVoted($user, $election))->toBeFalse();

    $election->users()->attach($user, ['has_voted' => true, 'voted_at' => now()]);

    expect($service->hasUserVoted($user, $election))->toBeTrue();
});

it('returns election results', function () {
    $election = Election::factory()->open()->create();
    $candidate1 = Candidate::factory()->create(['election_id' => $election->id]);
    $candidate2 = Candidate::factory()->create(['election_id' => $election->id]);

    // Create some votes
    $user1 = User::factory()->voter()->create();
    $user2 = User::factory()->voter()->create();

    $election->users()->attach([$user1->id, $user2->id], ['has_voted' => true]);

    $candidate1->votes()->create([
        'election_id' => $election->id,
        'voted_at' => now(),
    ]);

    $service = app(ElectionService::class);
    $results = $service->results($election);

    expect($results)->toHaveCount(2);
    expect($results[0]['votes'])->toBe(1);
    expect($results[0]['percentage'])->toBe(100.0);
});

it('casts a vote with lock for update', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $candidate = Candidate::factory()->create(['election_id' => $election->id]);

    $election->users()->attach($user, ['has_voted' => false]);

    $service = app(ElectionService::class);
    $vote = $service->cast($user, $candidate, '127.0.0.1', 'TestAgent');

    expect($vote->election_id)->toBe($election->id);
    expect($vote->candidate_id)->toBe($candidate->id);
    expect($vote->ip_hash)->not->toBeNull();
    expect($vote->user_agent_hash)->not->toBeNull();

    // Verify pivot was updated
    $this->assertDatabaseHas('election_user', [
        'election_id' => $election->id,
        'user_id' => $user->id,
        'has_voted' => true,
    ]);
});
