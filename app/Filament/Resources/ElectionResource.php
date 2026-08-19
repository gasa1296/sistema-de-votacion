<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ElectionResource\Pages;
use App\Filament\Resources\ElectionResource\RelationManagers\CandidatesRelationManager;
use App\Filament\Resources\ElectionResource\RelationManagers\VotersRelationManager;
use App\Models\Election;
use App\Services\ElectionService;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ElectionResource extends Resource
{
    protected static ?string $model = Election::class;

    protected static ?string $navigationLabel = 'Elecciones';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bolt';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Components\Section::make('Información de la Elección')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->rows(3),
                        Forms\Components\DateTimePicker::make('opens_at'),
                        Forms\Components\DateTimePicker::make('closes_at')
                            ->afterOrEqual('opens_at'),
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
                Tables\Columns\TextColumn::make('candidates_count')
                    ->counts('candidates')
                    ->label('Candidatos')
                    ->sortable(),
                Tables\Columns\TextColumn::make('votes_count')
                    ->counts('votes')
                    ->label('Votos')
                    ->sortable(),
                Tables\Columns\TextColumn::make('opens_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('closes_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Actions\EditAction::make(),
                Actions\Action::make('open')
                    ->label('Abrir')
                    ->icon('heroicon-m-play')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Abrir Elección')
                    ->modalDescription('¿Estás seguro de que quieres abrir esta elección para votación?')
                    ->visible(fn (Election $record): bool => $record->isPending() || $record->isClosed())
                    ->action(fn (Election $record) => app(ElectionService::class)->open($record)),
                Actions\Action::make('close')
                    ->label('Cerrar')
                    ->icon('heroicon-m-stop')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Cerrar Elección')
                    ->modalDescription('¿Estás seguro de que quieres cerrar esta elección?')
                    ->visible(fn (Election $record): bool => $record->isOpen())
                    ->action(fn (Election $record) => app(ElectionService::class)->close($record)),
                Actions\Action::make('exportPdf')
                    ->label('PDF')
                    ->icon('heroicon-m-document-arrow-down')
                    ->color('gray')
                    ->url(fn (Election $record): string => route('admin.election.export.pdf', $record)),
                Actions\Action::make('exportExcel')
                    ->label('Excel')
                    ->icon('heroicon-m-table-cells')
                    ->color('gray')
                    ->url(fn (Election $record): string => route('admin.election.export.excel', $record)),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CandidatesRelationManager::class,
            VotersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListElections::route('/'),
            'create' => Pages\CreateElection::route('/create'),
            'edit' => Pages\EditElection::route('/{record}/edit'),
        ];
    }
}
