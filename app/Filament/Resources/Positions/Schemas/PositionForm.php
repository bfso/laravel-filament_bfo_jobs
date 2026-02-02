<?php

namespace App\Filament\Resources\Positions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PositionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required(),
                Textarea::make('description')->required(),
                Textarea::make('internal_note'),
                DatePicker::make('end')->required(),
            ]);
    }
}
