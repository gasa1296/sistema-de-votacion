<?php

namespace App\Filament\Pages;

use App\Models\Election;
use App\Services\ElectionService;
use Filament\Pages\Page;

class ElectionResults extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-m-chart-bar';

    protected static string|\UnitEnum|null $navigationGroup = 'Resultados';

    protected static ?string $title = 'Resultados en Vivo';

    protected static ?string $slug = 'election-results';

    protected string $view = 'filament.pages.election-results';

    public ?array $results = null;

    public ?string $electionName = null;

    public function mount(): void
    {
        $election = Election::open()->first()
            ?? Election::closed()->latest()->first();

        if ($election) {
            $this->electionName = $election->name;
            $this->results = app(ElectionService::class)->results($election);
        }
    }
}
