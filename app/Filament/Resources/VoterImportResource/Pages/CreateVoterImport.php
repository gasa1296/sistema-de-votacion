<?php

namespace App\Filament\Resources\VoterImportResource\Pages;

use App\Filament\Resources\VoterImportResource;
use App\Jobs\ImportVotersJob;
use App\Models\Election;
use App\Models\User;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class CreateVoterImport extends Page
{
    protected static string $resource = VoterImportResource::class;

    protected string $view = 'filament.resources.voter-import-resource.pages.create-voter-import';

    public ?int $electionId = null;

    public ?string $filePath = null;

    public function mount(): void
    {
        $this->form->fill([]);
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
                ->required(),
        ];
    }

    public function import(): void
    {
        $data = $this->form->getState();

        $election = Election::findOrFail($data['election_id']);
        $user = User::first(); // Admin user

        ImportVotersJob::dispatch(
            $data['file']->store('imports', 'public'),
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
