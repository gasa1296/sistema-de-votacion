<?php

namespace App\Filament\Widgets;

use App\Models\Election;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ElectionStatsWidget extends StatsOverviewWidget
{
    public function getStats(): array
    {
        $election = Election::open()->first();

        $totalVoters = $election ? $election->users()->count() : 0;
        $totalVotes = $election ? $election->votes()->count() : 0;
        $percentage = $totalVoters > 0 ? round(($totalVotes / $totalVoters) * 100, 1) : 0;

        return [
            Stat::make('Elección activa', $election?->name ?? 'Ninguna')
                ->description($election?->status ?? 'Sin elección abierta')
                ->descriptionIcon($election?->isOpen() ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle')
                ->color($election?->isOpen() ? 'success' : 'gray'),
            Stat::make('Votantes habilitados', number_format($totalVoters))
                ->description('Total de votantes asignados')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
            Stat::make('Votos emitidos', number_format($totalVotes))
                ->description("{$percentage}% de participación")
                ->descriptionIcon('heroicon-m-check-badge')
                ->color($percentage >= 50 ? 'success' : 'warning'),
            Stat::make('Pendientes', number_format($totalVoters - $totalVotes))
                ->description('Votantes que aún no han votado')
                ->descriptionIcon('heroicon-m-clock')
                ->color('gray'),
        ];
    }
}
