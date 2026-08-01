<?php

use App\Jobs\ImportVotersJob;
use App\Mail\VoterCredentialsMail;
use App\Models\Election;
use App\Models\User;
use App\Models\VoterImport;
use Illuminate\Support\Facades\Mail;

function writeVotersCsv(string $content): string
{
    $path = sys_get_temp_dir().'/voters_'.uniqid().'.csv';

    file_put_contents($path, $content);

    return $path;
}

it('imports voters from csv and sends credentials', function () {
    Mail::fake();

    $election = Election::factory()->create();
    $admin = User::factory()->admin()->create();

    $csv = writeVotersCsv(
        "email,nombre,apellido\nana@test.com,Ana,Gomez\nluis@test.com,Luis,Perez\n"
    );

    (new ImportVotersJob($csv, $election, $admin))->handle();

    $ana = User::where('email', 'ana@test.com')->first();
    $luis = User::where('email', 'luis@test.com')->first();

    expect($ana)->not->toBeNull();
    expect($luis)->not->toBeNull();
    expect($ana->role)->toBe('voter');
    expect($ana->voter_code)->not->toBeNull();
    expect($ana->elections()->where('election_id', $election->id)->exists())->toBeTrue();

    Mail::assertQueued(VoterCredentialsMail::class, 2);

    $import = VoterImport::first();
    expect($import->election_id)->toBe($election->id);
    expect($import->total_rows)->toBe(2);
    expect($import->imported)->toBe(2);
    expect($import->failed)->toBe(0);
    expect($import->errors)->toBe([]);
});

it('does not duplicate voters with existing email', function () {
    $election = Election::factory()->create();
    $admin = User::factory()->admin()->create();
    $existing = User::factory()->voter()->create(['email' => 'ana@test.com']);

    $csv = writeVotersCsv(
        "email,nombre,apellido\nana@test.com,Ana,Gomez\n"
    );

    (new ImportVotersJob($csv, $election, $admin))->handle();

    expect(User::where('email', 'ana@test.com')->count())->toBe(1);
    expect($existing->fresh()->elections()->where('election_id', $election->id)->exists())->toBeTrue();
});

it('records failed rows with errors', function () {
    $election = Election::factory()->create();
    $admin = User::factory()->admin()->create();

    $csv = writeVotersCsv(
        "email,nombre,apellido\nana@test.com,Ana,Gomez\n,NoEmail,Apellido\n"
    );

    (new ImportVotersJob($csv, $election, $admin))->handle();

    $import = VoterImport::first();
    expect($import->total_rows)->toBe(2);
    expect($import->imported)->toBe(1);
    expect($import->failed)->toBe(1);
    expect($import->errors)->toHaveCount(1);
    expect($import->errors[0]['email'])->toBe('N/A');
});

it('fails rows when required columns are missing', function (string $csvContent) {
    $election = Election::factory()->create();
    $admin = User::factory()->admin()->create();

    $csv = writeVotersCsv($csvContent);

    (new ImportVotersJob($csv, $election, $admin))->handle();

    $import = VoterImport::first();
    expect($import->imported)->toBe(0);
    expect($import->failed)->toBe(1);
})->with([
    'missing email' => ["nombre,apellido\nAna,Gomez\n"],
    'missing name' => ["email,apellido\nana@test.com,Gomez\n"],
]);
