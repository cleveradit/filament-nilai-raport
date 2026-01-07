<?php

namespace App\Filament\Resources\Grades\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class GradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name') // Menampilkan nama dari tabel users
                    ->label('Nama Siswa')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('subject.mata_pelajaran') // Menampilkan nama mapel dari tabel subjects
                    ->label('Mata Pelajaran')
                    ->sortable(),

                TextColumn::make('nilai')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state >= 75 => 'success',
                        $state >= 60 => 'warning',
                        default => 'danger',
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('subject_id')
                    ->relationship('subject', 'mata_pelajaran')
                    ->label('Filter Mata Pelajaran'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
