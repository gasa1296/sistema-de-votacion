<?php

namespace App\Filament\Resources\VoterImportResource\Pages;

use App\Filament\Resources\VoterImportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVoterImports extends ListRecords
{
    protected static string $resource = VoterImportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
