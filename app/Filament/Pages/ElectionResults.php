<?php

namespace App\Filament\Pages;

use App\Models\Election;
use App\Services\ElectionService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ElectionResults extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-m-chart-bar';

    protected static string|\UnitEnum|null $navigationGroup = 'Resultados';

    protected static ?string $title = 'Resultados en Vivo';

    protected static ?string $slug = 'election-results';

    protected string $view = 'filament.pages.election-results';

    public const CHART_COLORS = [
        '#ef4444', // Rojo
        '#3b82f6', // Azul
        '#10b981', // Verde
        '#f59e0b', // Ámbar
        '#8b5cf6', // Púrpura
        '#ec4899', // Rosa
        '#06b6d4', // Cian
        '#f97316', // Naranja
        '#14b8a6', // Turquesa
        '#6366f1', // Índigo
    ];

    public ?int $selectedElectionId = null;

    public ?string $electionName = null;

    public ?string $electionStatus = null;

    public ?string $opensAt = null;

    public ?string $closesAt = null;

    public ?array $results = null;

    public array $turnout = [
        'total_voters' => 0,
        'total_votes' => 0,
        'percentage' => 0,
    ];

    public ?array $leader = null;

    public array $chartData = [
        'labels' => [],
        'values' => [],
        'percentages' => [],
        'colors' => [],
        'total_votes' => 0,
    ];

    public array $electionsList = [];

    public string $lastUpdated = '';

    public function mount(?int $election = null): void
    {
        $this->electionsList = Election::query()
            ->orderByDesc('created_at')
            ->get(['id', 'name', 'opens_at', 'closes_at'])
            ->map(fn (Election $el) => [
                'id' => $el->id,
                'name' => $el->name,
                'status' => $el->status,
            ])
            ->toArray();

        if ($election && Election::query()->whereKey($election)->exists()) {
            $this->selectedElectionId = $election;
        } else {
            $activeElection = Election::open()->first()
                ?? Election::closed()->latest()->first()
                ?? Election::latest()->first();

            $this->selectedElectionId = $activeElection?->id;
        }

        $this->loadElectionData();
    }

    public function updatedSelectedElectionId(): void
    {
        $this->loadElectionData();
    }

    public function refreshData(): void
    {
        $this->loadElectionData();

        Notification::make()
            ->title('Resultados actualizados')
            ->success()
            ->send();
    }

    public function loadElectionData(): void
    {
        $this->lastUpdated = now()->format('H:i:s');

        if (! $this->selectedElectionId) {
            $this->resetElectionData();

            return;
        }

        $election = Election::query()->find($this->selectedElectionId);

        if (! $election) {
            $this->resetElectionData();

            return;
        }

        $this->electionName = $election->name;
        $this->electionStatus = $election->status;
        $this->opensAt = $election->opens_at?->format('d/m/Y H:i');
        $this->closesAt = $election->closes_at?->format('d/m/Y H:i');

        $service = app(ElectionService::class);
        $rawResults = $service->results($election);
        $this->turnout = $service->turnout($election);

        $totalVotes = $this->turnout['total_votes'];
        $maxVotes = count($rawResults) > 0 ? max(array_column($rawResults, 'votes')) : 0;

        $cumulativePercentage = 0.0;
        $circumference = 251.3274; // 2 * PI * 40

        $formattedResults = [];
        $chartLabels = [];
        $chartValues = [];
        $chartPercentages = [];
        $chartColors = [];

        foreach ($rawResults as $index => $candidate) {
            $color = self::CHART_COLORS[$index % count(self::CHART_COLORS)];
            $percentage = (float) $candidate['percentage'];
            $votes = (int) $candidate['votes'];

            $dashLength = round(($percentage / 100) * $circumference, 3);
            $dashOffset = round(-($cumulativePercentage / 100) * $circumference, 3);
            $cumulativePercentage += $percentage;

            $isLeader = $votes > 0 && $votes === $maxVotes;

            $formattedResults[] = [
                'id' => $candidate['id'],
                'name' => $candidate['name'],
                'position' => $candidate['position'],
                'photo_path' => $candidate['photo_path'],
                'votes' => $votes,
                'percentage' => $percentage,
                'color' => $color,
                'rank' => $index + 1,
                'is_leader' => $isLeader,
                'dash_length' => $dashLength,
                'dash_offset' => $dashOffset,
                'diff_with_leader' => $maxVotes - $votes,
            ];

            $chartLabels[] = $candidate['name'];
            $chartValues[] = $votes;
            $chartPercentages[] = $percentage;
            $chartColors[] = $color;
        }

        $this->results = $formattedResults;
        $this->leader = ! empty($formattedResults) && $maxVotes > 0 ? $formattedResults[0] : null;

        $this->chartData = [
            'labels' => $chartLabels,
            'values' => $chartValues,
            'percentages' => $chartPercentages,
            'colors' => $chartColors,
            'total_votes' => $totalVotes,
        ];
    }

    private function resetElectionData(): void
    {
        $this->electionName = null;
        $this->electionStatus = null;
        $this->opensAt = null;
        $this->closesAt = null;
        $this->results = null;
        $this->leader = null;
        $this->turnout = [
            'total_voters' => 0,
            'total_votes' => 0,
            'percentage' => 0,
        ];
        $this->chartData = [
            'labels' => [],
            'values' => [],
            'percentages' => [],
            'colors' => [],
            'total_votes' => 0,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportExcel')
                ->label('Exportar Excel')
                ->icon('heroicon-m-table-cells')
                ->color('gray')
                ->url(fn (): ?string => $this->selectedElectionId ? route('admin.election.export.excel', $this->selectedElectionId) : null)
                ->openUrlInNewTab()
                ->visible(fn (): bool => filled($this->selectedElectionId)),

            Action::make('exportPdf')
                ->label('Exportar PDF')
                ->icon('heroicon-m-document-arrow-down')
                ->color('gray')
                ->url(fn (): ?string => $this->selectedElectionId ? route('admin.election.export.pdf', $this->selectedElectionId) : null)
                ->openUrlInNewTab()
                ->visible(fn (): bool => filled($this->selectedElectionId)),

            Action::make('refresh')
                ->label('Actualizar')
                ->icon('heroicon-m-arrow-path')
                ->color('primary')
                ->action('refreshData'),
        ];
    }
}
