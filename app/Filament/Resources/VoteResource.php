<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoteResource\Pages;
use App\Models\Vote;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class VoteResource extends Resource
{
    protected static ?string $model = Vote::class;

    protected static ?string $navigationLabel = 'Votos';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-check-circle';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('candidate.name')
                    ->label('Candidato')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('candidate.position')
                    ->label('Cargo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('election.name')
                    ->label('Elección')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ip_hash')
                    ->label('IP')
                    ->limit(16),
                Tables\Columns\TextColumn::make('voted_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('voted_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVotes::route('/'),
        ];
    }
}
