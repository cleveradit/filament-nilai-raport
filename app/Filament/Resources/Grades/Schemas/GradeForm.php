<?php

namespace App\Filament\Resources\Grades\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Nama Siswa')
                    ->relationship(
                        'user', 
                        'name', 
                        fn (Builder $query) => $query->isStudent()
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('subject_id')
                    ->label('Mata Pelajaran')
                    ->relationship('subject', 'mata_pelajaran') // Mengambil 'mata_pelajaran' dari tabel subjects
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nilai')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
            ]);
    }
}
