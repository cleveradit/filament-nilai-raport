<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('mata_pelajaran')
                    ->label('Mata Pelajaran')
                    ->required(),
            ]);
    }
}
