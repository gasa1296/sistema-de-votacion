<?php

namespace App\Http\Middleware;

use App\Models\Election;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureElectionIsOpen
{
    public function handle(Request $request, Closure $next): Response
    {
        $election = Election::open()->first();

        if (! $election) {
            return redirect()->route('voter.election-closed');
        }

        $request->attributes->set('election', $election);

        return $next($request);
    }
}
