<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Services\ElectionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResultsController extends Controller
{
    public function show(Request $request)
    {
        $election = Election::open()->first()
            ?? Election::closed()->latest()->first();

        if (! $election) {
            return Inertia::render('voter/ElectionClosed');
        }

        $results = app(ElectionService::class)->results($election);

        return Inertia::render('voter/Results/Index', [
            'election' => $election,
            'results' => $results,
        ]);
    }
}
