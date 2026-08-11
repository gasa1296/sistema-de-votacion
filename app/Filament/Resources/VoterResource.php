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

class VoterResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Votantes';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        $form = [
            Forms\Components\TextInput::make('name')
                ->label('Nombre')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('last_name')
                ->label('Apellido')
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('voter_code')
                ->label('Código del Votante')
                ->maxLength(255)
                ->disabled(),
        ];
        if (config('app.debug')) {
            $form[] = Forms\Components\TextInput::make('password')
                ->label('Contraseña')
                ->maxLength(255)
                ->password()
                ->dehydrated(fn ($state): bool => filled($state));
        }

        return $schema
            ->schema([
                Schemas\Components\Section::make('Información del Votante')
                    ->schema($form)->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('voter_code')
                    ->label('Código')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Actions\Action::make('resendCredentials')
                    ->label('Reenviar credenciales')
                    ->icon('heroicon-m-envelope')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Reenviar credenciales')
                    ->modalDescription('¿Estás seguro de que quieres reenviar las credenciales a este votante?')
                    ->action(fn (User $record) => SendVoterCredentialsJob::dispatch($record, 'password-temporal')),
                Actions\DeleteAction::make()
                    ->label('Eliminar')
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Eliminar Votante')
                    ->modalDescription('¿Estás seguro de que quieres eliminar este votante?'),
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
