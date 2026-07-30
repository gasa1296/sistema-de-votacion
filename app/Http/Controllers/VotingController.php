<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Services\ElectionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VotingController extends Controller
{
    public function index(Request $request): Response
    {
        $election = $request->attributes->get('election');

        $user = $request->user();

        $hasVoted = app(ElectionService::class)->hasUserVoted($user, $election);

        $candidates = $election->candidates()
            ->where('active', true)
            ->orderBy('display_order')
            ->get();

        $turnout = app(ElectionService::class)->turnout($election);
        $results = app(ElectionService::class)->results($election);

        return Inertia::render('voter/Vote/Index', [
            'election' => $election,
            'candidates' => $candidates,
            'hasVoted' => $hasVoted,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'last_name' => $user->last_name,
            ],
            'turnout' => $turnout,
            'results' => $results,
        ]);
    }

    public function store(StoreVoteRequest $request): RedirectResponse
    {
        $election = $request->attributes->get('election');
        $candidate = $election->candidates()->findOrFail($request->validated('candidate_id'));

        try {
            $vote = app(ElectionService::class)->cast(
                $user = $request->user(),
                $candidate,
                $request->ip(),
                $request->userAgent(),
            );
        } catch (\RuntimeException $e) {
            if ($e->getMessage() === 'Usuario no está asignado a esta elección.') {
                return redirect()->route('voter.election-closed');
            }

            return redirect()->route('voter.already-voted');
        }

        return redirect()->route('voter.thanks');
    }
}
