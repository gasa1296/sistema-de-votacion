<?php

use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use App\Models\Vote;
use Maatwebsite\Excel\Facades\Excel;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->election = Election::factory()->closed()->create(['name' => 'Eleccion 2026']);
    $candidate = Candidate::factory()->create(['election_id' => $this->election->id]);
    Vote::create([
        'election_id' => $this->election->id,
        'candidate_id' => $candidate->id,
        'ip_hash' => hash_hmac('sha256', '127.0.0.1', config('app.key')),
        'user_agent_hash' => hash_hmac('sha256', 'Agent', config('app.key')),
        'voted_at' => now(),
    ]);
});

test('admin can export election results as excel', function () {
    Excel::fake();

    $this->actingAs($this->admin)
        ->get(route('admin.election.export.excel', $this->election))
        ->assertOk();

    Excel::assertDownloaded('resultados-Eleccion 2026.xlsx');
});

test('admin can export election results as pdf', function () {
    $this->actingAs($this->admin)
        ->get(route('admin.election.export.pdf', $this->election))
        ->assertOk();
});

test('voter cannot export election results', function () {
    $voter = User::factory()->voter()->create();

    $this->actingAs($voter, 'web')
        ->get(route('admin.election.export.excel', $this->election))
        ->assertForbidden();

    $this->actingAs($voter, 'web')
        ->get(route('admin.election.export.pdf', $this->election))
        ->assertForbidden();
});

test('guest is redirected to voter login when trying to export', function () {
    $this->get(route('admin.election.export.excel', $this->election))
        ->assertRedirect(route('voter.login'));

    $this->get(route('admin.election.export.pdf', $this->election))
        ->assertRedirect(route('voter.login'));
});
