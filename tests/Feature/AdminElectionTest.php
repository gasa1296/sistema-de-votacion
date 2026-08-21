<?php

use App\Filament\Pages\ElectionResults;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use App\Models\Vote;
use App\Services\ElectionService;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;

test('admin can manage elections', function () {
    $admin = User::factory()->admin()->create();
    $election = Election::factory()->create();

    expect(Gate::forUser($admin)->allows('viewAny', Election::class))->toBeTrue();
    expect(Gate::forUser($admin)->allows('view', $election))->toBeTrue();
    expect(Gate::forUser($admin)->allows('create', Election::class))->toBeTrue();
    expect(Gate::forUser($admin)->allows('update', $election))->toBeTrue();
    expect(Gate::forUser($admin)->allows('delete', $election))->toBeTrue();
});

test('voter cannot manage elections', function () {
    $voter = User::factory()->voter()->create();
    $election = Election::factory()->create();

    expect(Gate::forUser($voter)->denies('viewAny', Election::class))->toBeTrue();
    expect(Gate::forUser($voter)->denies('view', $election))->toBeTrue();
    expect(Gate::forUser($voter)->denies('update', $election))->toBeTrue();
    expect(Gate::forUser($voter)->denies('delete', $election))->toBeTrue();
});

test('admin can open and close an election', function () {
    $admin = User::factory()->admin()->create();
    $election = Election::factory()->pending()->create();

    $this->actingAs($admin);

    $this->assertTrue(Gate::forUser($admin)->allows('update', $election));

    app(ElectionService::class)->open($election);

    expect($election->fresh()->status)->toBe('open');

    app(ElectionService::class)->close($election);

    expect($election->fresh()->status)->toBe('closed');
});

test('voter cannot update another voter', function () {
    $voter = User::factory()->voter()->create();
    $target = User::factory()->voter()->create();

    expect(Gate::forUser($voter)->denies('update', $target))->toBeTrue();
});

test('only admin can view votes', function () {
    $admin = User::factory()->admin()->create();
    $voter = User::factory()->voter()->create();
    $election = Election::factory()->create();
    $candidate = Candidate::factory()->create(['election_id' => $election->id]);

    $vote = Vote::create([
        'election_id' => $election->id,
        'candidate_id' => $candidate->id,
        'voted_at' => now(),
    ]);

    expect(Gate::forUser($admin)->allows('viewAny', Vote::class))->toBeTrue();
    expect(Gate::forUser($admin)->allows('view', $vote))->toBeTrue();
    expect(Gate::forUser($voter)->denies('viewAny', Vote::class))->toBeTrue();
});

test('admin can view election results page with pie chart and ranking', function () {
    $admin = User::factory()->admin()->create();
    $election = Election::factory()->open()->create(['name' => 'Elección Presidencial']);
    $candidate1 = Candidate::factory()->create([
        'election_id' => $election->id,
        'name' => 'Ana Morales',
        'position' => 'Presidenta',
    ]);
    $candidate2 = Candidate::factory()->create([
        'election_id' => $election->id,
        'name' => 'Carlos Mendoza',
        'position' => 'Vicepresidente',
    ]);

    Vote::create([
        'election_id' => $election->id,
        'candidate_id' => $candidate1->id,
        'voted_at' => now(),
    ]);

    $this->actingAs($admin);

    Livewire::test(ElectionResults::class)
        ->assertSuccessful()
        ->assertSee('Elección Presidencial')
        ->assertSee('Ana Morales')
        ->assertSee('Carlos Mendoza')
        ->assertSee('Gráfica de Resultados')
        ->assertSee('Votos Emitidos')
        ->assertSee('Padrón Habilitado')
        ->assertSee('Participación');
});

test('election results page handles empty states and election switching', function () {
    $admin = User::factory()->admin()->create();
    $this->actingAs($admin);

    Livewire::test(ElectionResults::class)
        ->assertSuccessful();

    $electionA = Election::factory()->closed()->create(['name' => 'Elección Alpha']);
    $electionB = Election::factory()->open()->create(['name' => 'Elección Beta']);

    Livewire::test(ElectionResults::class)
        ->assertSuccessful()
        ->set('selectedElectionId', $electionA->id)
        ->assertSee('Elección Alpha')
        ->set('selectedElectionId', $electionB->id)
        ->assertSee('Elección Beta');
});
