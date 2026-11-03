<?php

use App\Exports\ElectionVotedUsersExport;
use App\Filament\Pages\ElectionResults;
use App\Filament\Resources\ElectionResource\Pages\EditElection;
use App\Filament\Resources\ElectionResource\Pages\ListElections;
use App\Filament\Resources\ElectionResource\RelationManagers\VotersRelationManager;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use App\Models\Vote;
use Livewire\Livewire;
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

    $this->get(route('admin.election.export.voters.excel', $this->election))
        ->assertRedirect(route('voter.login'));
});

test('admin can export election voted users as excel', function () {
    Excel::fake();

    $votedUser = User::factory()->voter()->create([
        'name' => 'Juan',
        'last_name' => 'Pérez',
        'email' => 'juan@example.com',
    ]);
    $pendingUser = User::factory()->voter()->create([
        'name' => 'María',
        'last_name' => 'Gómez',
        'email' => 'maria@example.com',
    ]);

    $this->election->users()->attach($votedUser->id, [
        'has_voted' => true,
        'voted_at' => '2026-11-02 15:30:00',
    ]);
    $this->election->users()->attach($pendingUser->id, [
        'has_voted' => false,
        'voted_at' => null,
    ]);

    $this->actingAs($this->admin)
        ->get(route('admin.election.export.voters.excel', $this->election))
        ->assertOk();

    Excel::assertDownloaded('votantes-Eleccion 2026.xlsx', function (ElectionVotedUsersExport $export) {
        $rows = $export->collection();

        return $rows->count() === 1
            && $export->headings() === ['Nombre', 'Apellido', 'Email']
            && $rows->first() === [
                'Nombre' => 'Juan',
                'Apellido' => 'Pérez',
                'Email' => 'juan@example.com',
            ];
    });
});

test('voter cannot export election voted users', function () {
    $voter = User::factory()->voter()->create();

    $this->actingAs($voter, 'web')
        ->get(route('admin.election.export.voters.excel', $this->election))
        ->assertForbidden();
});

test('filament panel exposes export voted users action in elections, voters relation manager, and live results', function () {
    $this->actingAs($this->admin);

    Livewire::test(ListElections::class)
        ->assertTableActionExists('exportVotedUsers');

    Livewire::test(VotersRelationManager::class, [
        'ownerRecord' => $this->election,
        'pageClass' => EditElection::class,
    ])
        ->assertTableActionExists('exportVotedUsers');

    Livewire::test(ElectionResults::class, ['election' => $this->election->id])
        ->assertActionVisible('exportVotedUsers');
});
