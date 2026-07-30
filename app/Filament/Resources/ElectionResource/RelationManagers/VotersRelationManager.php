<?php

namespace App\Filament\Resources\ElectionResource\RelationManagers;

use App\Models\User;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class VotersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Votante')
                    ->options(function (): array {
                        $assignedIds = $this->getOwnerRecord()->users()
                            ->pluck('users.id')
                            ->toArray();

                        return User::query()
                            ->where('role', 'voter')
                            ->whereNotIn('id', $assignedIds)
                            ->get()
                            ->mapWithKeys(fn (User $user): array => [
                                $user->id => "{$user->name} {$user->last_name} ({$user->email})",
                            ])
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('voter_code')
                    ->label('Código'),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->label('Asignar votante')
                    ->modalHeading('Asignar votante a la elección')
                    ->modalSubmitActionLabel('Asignar')
                    ->mutateFormDataUsing(function (array $data): array {
                        return [
                            'user_id' => $data['user_id'],
                        ];
                    })
                    ->using(function (array $data): void {
                        $this->getOwnerRecord()->users()->attach($data['user_id']);
                    }),
            ])
            ->actions([
                Actions\DetachAction::make()
                    ->label('Desasignar')
                    ->modalHeading('Desasignar votante')
                    ->modalDescription('¿Estás seguro de que quieres desasignar este votante de la elección?'),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
