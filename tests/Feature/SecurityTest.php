<?php

use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use App\Services\ElectionService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

test('bcrypt rounds are set to 12', function () {
    $env = file_get_contents(base_path('.env'));

    expect($env)->toContain('BCRYPT_ROUNDS=12');
});

test('votes do not store a user id (anonymity)', function () {
    expect(DB::getSchemaBuilder()->hasColumn('votes', 'user_id'))->toBeFalse();
});

test('election_user pivot enforces a unique per voter per election', function () {
    $election = Election::factory()->create();
    $user = User::factory()->voter()->create();

    $election->users()->attach($user);

    expect(fn () => $election->users()->attach($user))->toThrow(QueryException::class);
});

test('ip hash is an hmac of the ip address', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $candidate = Candidate::factory()->create(['election_id' => $election->id]);
    $election->users()->attach($user, ['has_voted' => false]);

    $vote = app(ElectionService::class)->cast($user, $candidate, '203.0.113.7', 'TestAgent');

    expect($vote->ip_hash)->toBe(hash_hmac('sha256', '203.0.113.7', config('app.key')));
    expect($vote->ip_hash)->not->toBe('203.0.113.7');
    expect($vote->user_agent_hash)->not->toBe('TestAgent');
});

test('casting a vote writes an audit log entry', function () {
    $logger = Mockery::mock();
    $logger->shouldReceive('info')->once();

    Log::shouldReceive('channel')->with('audit')->andReturn($logger);

    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $candidate = Candidate::factory()->create(['election_id' => $election->id]);
    $election->users()->attach($user, ['has_voted' => false]);

    app(ElectionService::class)->cast($user, $candidate, '127.0.0.1', 'Agent');
});

test('audit log channel is configured', function () {
    $audit = config('logging.channels.audit');

    expect($audit)->not->toBeNull();
    expect($audit['driver'])->toBe('daily');
});

test('voter login is rate limited', function () {
    foreach (range(1, 5) as $attempt) {
        $this->post(route('voter.login.store'), [
            'email' => 'limiter@test.com',
            'password' => 'wrong',
        ]);
    }

    $this->post(route('voter.login.store'), [
        'email' => 'limiter@test.com',
        'password' => 'wrong',
    ])->assertTooManyRequests();
});

test('vote store is rate limited', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $candidate = Candidate::factory()->create(['election_id' => $election->id]);
    $election->users()->attach($user, ['has_voted' => false]);

    $this->actingAs($user, 'voter');

    foreach (range(1, 5) as $attempt) {
        $this->post(route('voter.vote.store'), [
            'candidate_id' => $candidate->id,
        ]);
    }

    $this->post(route('voter.vote.store'), [
        'candidate_id' => $candidate->id,
    ])->assertTooManyRequests();
});
