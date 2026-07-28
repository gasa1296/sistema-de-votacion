<?php

namespace App\Exports;

use App\Models\Election;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ElectionResultsExport implements FromCollection, WithHeadings
{
    public function __construct(
        private readonly Election $election,
    ) {}

    public function collection(): Collection
    {
        return $this->election->votes()
            ->with('candidate', 'user')
            ->get()
            ->map(fn ($vote) => [
                'Candidato' => $vote->candidate->name.' '.($vote->candidate->last_name ?? ''),
                'Cargo' => $vote->candidate->position,
                'Email Votante' => $vote->user->email,
                'Código Votante' => $vote->user->voter_code,
                'IP Hash' => $vote->ip_hash ? substr($vote->ip_hash, 0, 16).'...' : 'N/A',
                'Fecha Voto' => $vote->voted_at->format('Y-m-d H:i:s'),
            ]);
    }

    public function headings(): array
    {
        return ['Candidato', 'Cargo', 'Email Votante', 'Código Votante', 'IP Hash', 'Fecha Voto'];
    }
}
