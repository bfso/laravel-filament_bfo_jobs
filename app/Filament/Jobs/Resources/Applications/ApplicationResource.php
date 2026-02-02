<?php

namespace App\Filament\Jobs\Resources\Applications;

use App\Filament\Jobs\Resources\Applications\Pages\CreateApplication;
use App\Filament\Jobs\Resources\Applications\Pages\EditApplication;
use App\Filament\Jobs\Resources\Applications\Pages\ListApplications;
use App\Filament\Jobs\Resources\Applications\Pages\ViewApplication;
use App\Filament\Jobs\Resources\Applications\Schemas\ApplicationForm;
use App\Filament\Jobs\Resources\Applications\Tables\ApplicationsTable;
use App\Models\Application;
use BackedEnum;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'lastname';

    public static function form(Schema $schema): Schema
    {
        return ApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('user.name'),
            TextEntry::make('user.email'),
            TextEntry::make('position.title'),
            TextEntry::make('description')
                ->getStateUsing(function ($record) {
                    return new HtmlString($record->description);
                }),
            TextEntry::make('document')
                ->label('CV')
                ->url(
                    fn($record) => route('documents.download', $record),
                    shouldOpenInNewTab: true
                ),
        ]);
    }

    public static function table(Table $table): Table
    {
        return ApplicationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApplications::route('/'),
            'create' => CreateApplication::route('/create'),
            'edit' => EditApplication::route('/{record}/edit'),
            'view' => ViewApplication::route('/{record}/view'),
        ];
    }
}
