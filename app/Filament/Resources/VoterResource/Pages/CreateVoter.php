<?php

namespace App\Filament\Resources\VoterResource\Pages;

use App\Filament\Resources\VoterResource;
use App\Jobs\SendVoterCredentialsJob;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateVoter extends CreateRecord
{
    protected static string $resource = VoterResource::class;

    protected function handleRecordCreation(array $data): User
    {
        $plainPassword = Str::password(symbols: false);

        $data['password'] = bcrypt($plainPassword);
        $data['must_change_password'] = true;
        $data['role'] = 'voter';

        $record = parent::handleRecordCreation($data);

        SendVoterCredentialsJob::dispatch($record, $plainPassword);

        return $record;
    }
}
