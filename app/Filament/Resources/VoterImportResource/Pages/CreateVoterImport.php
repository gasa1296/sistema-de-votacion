<?php

namespace App\Filament\Resources\VoterImportResource\Pages;

use App\Filament\Resources\VoterImportResource;
use App\Jobs\ImportVotersJob;
use App\Models\Election;
use App\Models\User;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Schema;

class CreateVoterImport extends Page
{
    protected static string $resource = VoterImportResource::class;

    protected string $view = 'filament.resources.voter-import-resource.pages.create-voter-import';

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill([]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components($this->getFormSchema())
            ->statePath('data');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('election_id')
                ->label('Elección')
                ->options(Election::pluck('name', 'id'))
                ->required()
                ->reactive(),
            Forms\Components\FileUpload::make('file')
                ->label('Archivo CSV/Excel')
                ->acceptedFileTypes(['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ->maxSize(10240)
                ->required(),
        ];
    }

    public function import(): void
    {
        $data = $this->form->getState();

        $election = Election::findOrFail($data['election_id']);
        $user = auth()->user(); // Admin user

        ImportVotersJob::dispatch(
            $data['file'],
            $election,
            $user,
        );

        Notification::make()
            ->title('Importación iniciada')
            ->body('El archivo está siendo procesado en segundo plano.')
            ->success()
            ->send();

        $this->form->fill([]);
    }
}
