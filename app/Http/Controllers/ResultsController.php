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

        $service = app(ElectionService::class);
        $results = $service->results($election);
        $turnout = $service->turnout($election);

        $user = $request->user('voter');

        return Inertia::render('voter/Results/Index', [
            'election' => $election,
            'results' => $results,
            'turnout' => $turnout,
            'user' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'last_name' => $user->last_name,
            ] : null,
        ]);
    }
}
