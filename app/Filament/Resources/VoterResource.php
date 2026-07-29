<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoterResource\Pages;
use App\Jobs\SendVoterCredentialsJob;
use App\Models\User;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VoterResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Components\Section::make('Información del Votante')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('voter_code')
                            ->maxLength(255)
                            ->disabled(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('voter_code')
                    ->label('Código')
                    ->searchable(),
                Tables\Columns\IconColumn::make('has_voted')
                    ->label('Votó')
                    ->boolean()
                    ->getStateUsing(fn (User $record): bool => $record->elections()
                        ->wherePivot('has_voted', true)
                        ->exists()),
                Tables\Columns\IconColumn::make('must_change_password')
                    ->label('Cambiar contraseña')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('has_voted')
                    ->label('Estado de voto')
                    ->options([
                        '1' => 'Ya votó',
                        '0' => 'No ha votado',
                    ])
                    ->query(fn (Builder $query, array $data): Builder => match ($data['value'] ?? null) {
                        '1' => $query->whereHas('elections', fn ($q) => $q->wherePivot('has_voted', true)),
                        '0' => $query->whereDoesntHave('elections', fn ($q) => $q->wherePivot('has_voted', true)),
                        default => $query,
                    }),
            ])
            ->actions([
                Actions\Action::make('resendCredentials')
                    ->label('Reenviar credenciales')
                    ->icon('heroicon-m-envelope')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Reenviar credenciales')
                    ->modalDescription('¿Estás seguro de que quieres reenviar las credenciales a este votante?')
                    ->action(fn (User $record) => SendVoterCredentialsJob::dispatch($record, 'password-temporal')),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                    Actions\BulkAction::make('resendCredentials')
                        ->label('Reenviar credenciales')
                        ->icon('heroicon-m-envelope')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each(
                            fn (User $record) => SendVoterCredentialsJob::dispatch($record, 'password-temporal')
                        )),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVoters::route('/'),
            'create' => Pages\CreateVoter::route('/create'),
            'edit' => Pages\EditVoter::route('/{record}/edit'),
        ];
    }
}
