<?php

namespace App\Filament\Widgets;

use App\Models\Election;
use Filament\Widgets\ChartWidget;

class LiveResultsWidget extends ChartWidget
{
    protected ?string $heading = 'Resultados en Vivo';

    protected ?string $pollingInterval = '5s';

    protected static ?int $sort = 2;

    public function getData(): array
    {
        $election = Election::open()->first();

        if (! $election) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $candidates = $election->candidates()
            ->withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Votos',
                    'data' => $candidates->pluck('votes_count')->toArray(),
                    'backgroundColor' => [
                        '#f59e0b',
                        '#3b82f6',
                        '#10b981',
                        '#ef4444',
                        '#8b5cf6',
                        '#ec4899',
                        '#06b6d4',
                        '#84cc16',
                    ],
                ],
            ],
            'labels' => $candidates->map(
                fn ($c) => $c->name.' '.($c->last_name ?? '')
            )->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
