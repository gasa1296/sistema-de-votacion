<?php

namespace App\Http\Middleware;

use App\Models\Election;
use App\Services\ElectionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasNotVoted
{
    public function handle(Request $request, Closure $next): Response
    {
        $election = $request->attributes->get('election');

        if (! $election) {
            $election = Election::open()->first();
        }

        if ($election && app(ElectionService::class)->hasUserVoted($request->user(), $election)) {
            return redirect()->route('voter.already-voted');
        }

        return $next($request);
    }
}
