<?php

use App\Http\Controllers\Auth\VoterLoginController;
use App\Http\Controllers\ElectionExportController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\VotingController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

// Voter routes
Route::middleware('guest:voter')->group(function () {
    Route::get('/login', fn () => inertia('voter/Login'))->name('voter.login');
    Route::post('/login', [VoterLoginController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('voter.login.store');
});

Route::middleware(['auth:voter'])->group(function () {
    Route::get('/', [VotingController::class, 'index'])
        ->middleware('election.open')
        ->name('voter.vote');

    Route::post('/votar', [VotingController::class, 'store'])
        ->middleware(['election.open', 'has.not.voted', 'throttle:5,1'])
        ->name('voter.vote.store');

    Route::post('/logout', [VoterLoginController::class, 'destroy'])->name('voter.logout');

    Route::get('/gracias', fn () => inertia('voter/Thanks'))->name('voter.thanks');
    Route::get('/ya-votaste', fn () => inertia('voter/AlreadyVoted'))->name('voter.already-voted');
    Route::get('/eleccion-cerrada', fn () => inertia('voter/ElectionClosed'))->name('voter.election-closed');
    Route::get('/eleccion-no-abierta', fn () => inertia('voter/ElectionNotOpen'))->name('voter.election-not-open');

    Route::get('/resultados', [ResultsController::class, 'show'])->name('voter.results');
});

// Export routes (admin guard handled by Filament, but we add for direct access)
Route::middleware(['auth:web', 'can:viewAny,App\Models\Election'])->group(function () {
    Route::get('/elecciones/{election}/exportar/pdf', [ElectionExportController::class, 'pdf'])
        ->name('admin.election.export.pdf');
    Route::get('/elecciones/{election}/exportar/excel', [ElectionExportController::class, 'excel'])
        ->name('admin.election.export.excel');
});
