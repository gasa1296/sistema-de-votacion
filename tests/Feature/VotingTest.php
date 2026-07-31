<?php

use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\AssertableInertia as Assert;

test('voter can see voting page with open election', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $candidate = Candidate::factory()->create(['election_id' => $election->id]);

    $election->users()->attach($user, ['has_voted' => false]);

    $this->actingAs($user, 'voter');

    $response = $this->get(route('voter.vote'));

    $response->assertSuccessful();
    $response->assertOk();
});

test('voter is redirected when no open election', function () {
    $user = User::factory()->voter()->create();

    $this->actingAs($user, 'voter');

    $response = $this->get(route('voter.vote'));

    $response->assertRedirect(route('voter.election-closed'));
});

test('voter can cast a vote', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $candidate = Candidate::factory()->create(['election_id' => $election->id]);

    $election->users()->attach($user, ['has_voted' => false]);

    Session::start();
    $this->actingAs($user, 'voter');

    $response = $this->post(route('voter.vote.store'), [
        'candidate_id' => $candidate->id,
    ]);

    $response->assertRedirect(route('voter.thanks'));
    $this->assertDatabaseHas('votes', [
        'election_id' => $election->id,
        'candidate_id' => $candidate->id,
    ]);
    $this->assertDatabaseHas('election_user', [
        'election_id' => $election->id,
        'user_id' => $user->id,
        'has_voted' => true,
    ]);
});

test('voter cannot vote twice', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $candidate = Candidate::factory()->create(['election_id' => $election->id]);

    $election->users()->attach($user, ['has_voted' => true, 'voted_at' => now()]);

    Session::start();
    $this->actingAs($user, 'voter');

    $response = $this->post(route('voter.vote.store'), [
        'candidate_id' => $candidate->id,
    ]);

    $response->assertRedirect(route('voter.already-voted'));
});

test('voter cannot vote for inactive candidate', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $candidate = Candidate::factory()->inactive()->create(['election_id' => $election->id]);

    $election->users()->attach($user, ['has_voted' => false]);

    Session::start();
    $this->actingAs($user, 'voter');

    $response = $this->post(route('voter.vote.store'), [
        'candidate_id' => $candidate->id,
    ]);

    $response->assertSessionHasErrors('candidate_id');
});

test('voter cannot vote for candidate from different election', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();
    $otherElection = Election::factory()->open()->create();
    $candidate = Candidate::factory()->create(['election_id' => $otherElection->id]);

    $election->users()->attach($user, ['has_voted' => false]);

    Session::start();
    $this->actingAs($user, 'voter');

    $response = $this->post(route('voter.vote.store'), [
        'candidate_id' => $candidate->id,
    ]);

    $response->assertSessionHasErrors('candidate_id');
});

test('unauthenticated user is redirected to login', function () {
    $response = $this->get(route('voter.vote'));

    $response->assertRedirect();
});

test('voter can see results page', function () {
    $user = User::factory()->voter()->create();
    $election = Election::factory()->open()->create();

    $this->actingAs($user, 'voter');

    $response = $this->get(route('voter.results'));

    $response->assertSuccessful();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('voter/Results/Index')
        ->where('user.name', $user->name)
        ->where('user.last_name', $user->last_name));
});

test('guest sees results page without user', function () {
    $election = Election::factory()->open()->create();

    $response = $this->get(route('voter.results'));

    $response->assertSuccessful();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('voter/Results/Index')
        ->where('user', null));
});
