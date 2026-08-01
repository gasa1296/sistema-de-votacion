<?php

namespace App\Http\Controllers;

use App\Exports\ElectionResultsExport;
use App\Models\Election;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ElectionExportController extends Controller
{
    public function pdf(Election $election)
    {
        $results = $election->votes()
            ->with('candidate')
            ->get()
            ->map(fn ($vote) => [
                'candidate' => $vote->candidate->name.' '.($vote->candidate->last_name ?? ''),
                'position' => $vote->candidate->position,
                'ip_hash' => $vote->ip_hash ? substr($vote->ip_hash, 0, 16).'...' : 'N/A',
                'voted_at' => $vote->voted_at->format('Y-m-d H:i:s'),
            ]);

        $election->loadCount('votes');

        $pdf = Pdf::loadView('exports.results', [
            'election' => $election,
            'results' => $results,
        ]);

        return $pdf->download("resultados-{$election->name}.pdf");
    }

    public function excel(Election $election)
    {
        return Excel::download(
            new ElectionResultsExport($election),
            "resultados-{$election->name}.xlsx"
        );
    }
}
