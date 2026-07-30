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
        if (empty($data['password'])) {
            $plainPassword = Str::password(symbols: false);
        } else {
            $plainPassword = $data['password'];
        }

        $data['password'] = bcrypt($plainPassword);
        $data['role'] = 'voter';

        $record = parent::handleRecordCreation($data);

        SendVoterCredentialsJob::dispatch($record, $plainPassword);

        return $record;
    }
}
