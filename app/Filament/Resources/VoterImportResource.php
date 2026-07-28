<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoterImportResource\Pages;
use App\Models\Election;
use App\Models\VoterImport;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class VoterImportResource extends Resource
{
    protected static ?string $model = VoterImport::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Components\Section::make('Importar Votantes')
                    ->schema([
                        Forms\Components\Select::make('election_id')
                            ->label('Elección')
                            ->options(Election::pluck('name', 'id'))
                            ->required()
                            ->reactive(),
                        Forms\Components\FileUpload::make('file')
                            ->label('Archivo CSV/Excel')
                            ->acceptedFileTypes(['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('election.name')
                    ->label('Elección')
                    ->sortable(),
                Tables\Columns\TextColumn::make('filename')
                    ->label('Archivo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_rows')
                    ->label('Total')
                    ->sortable(),
                Tables\Columns\TextColumn::make('imported')
                    ->label('Importados')
                    ->sortable()
                    ->color('success'),
                Tables\Columns\TextColumn::make('failed')
                    ->label('Fallidos')
                    ->sortable()
                    ->color('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVoterImports::route('/'),
            'create' => Pages\CreateVoterImport::route('/create'),
        ];
    }
}
