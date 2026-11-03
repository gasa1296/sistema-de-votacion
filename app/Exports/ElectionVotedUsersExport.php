<?php

namespace App\Exports;

use App\Models\Election;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

/**
 * @implements FromCollection<int, array{Nombre: string, Apellido: string, Email: string}>
 */
class ElectionVotedUsersExport implements FromCollection, WithHeadings
{
    public function __construct(
        private readonly Election $election,
    ) {}

    /**
     * @return Collection<int, array{Nombre: string, Apellido: string, Email: string}>
     */
    public function collection(): Collection
    {
        return $this->election->users()
            ->wherePivot('has_voted', true)
            ->get()
            ->map(function ($user): array {
                /** @var User $user */
                return [
                    'Nombre' => (string) $user->name,
                    'Apellido' => (string) ($user->last_name ?? ''),
                    'Email' => (string) $user->email,
                ];
            });
    }

    /**
     * @return array<int, string>
     */
    public function headings(): array
    {
        return ['Nombre', 'Apellido', 'Email'];
    }
}
