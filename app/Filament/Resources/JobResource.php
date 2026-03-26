<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Stelleninserate';

    protected static ?string $pluralModelLabel = 'Stelleninserate';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('company_id')
                ->relationship('company', 'company_name')
                ->required()
                ->searchable()
                ->label('Unternehmen'),

            Select::make('category_id')
                ->relationship('category', 'name')
                ->required()
                ->label('Kategorie'),

            Select::make('location_id')
                ->relationship('location', 'name')
                ->required()
                ->label('Ort'),

            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->label('Titel'),

            Textarea::make('description')
                ->required()
                ->rows(5)
                ->columnSpanFull()
                ->label('Beschreibung'),

            TextInput::make('canton')
                ->maxLength(2)
                ->label('Kanton'),

            TextInput::make('zip')
                ->maxLength(10)
                ->label('PLZ'),

            Select::make('language')
                ->options([
                    'Deutsch'     => 'Deutsch',
                    'Französisch' => 'Französisch',
                    'Italienisch' => 'Italienisch',
                    'Englisch'    => 'Englisch',
                ])
                ->label('Sprache'),

            Select::make('workplace')
                ->options([
                    'Onsite' => 'Onsite',
                    'Remote' => 'Remote',
                    'Hybrid' => 'Hybrid',
                ])
                ->label('Arbeitsort'),

            Toggle::make('home_office')
                ->label('Home Office möglich'),

            TextInput::make('email')
                ->email()
                ->maxLength(255)
                ->label('Kontakt E-Mail'),

            TextInput::make('phone')
                ->tel()
                ->maxLength(50)
                ->label('Kontakt Telefon'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Titel'),

                Tables\Columns\TextColumn::make('company.company_name')
                    ->sortable()
                    ->label('Unternehmen'),

                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->label('Kategorie'),

                Tables\Columns\TextColumn::make('location.name')
                    ->sortable()
                    ->label('Ort'),

                Tables\Columns\TextColumn::make('email')
                    ->label('E-Mail')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('home_office')
                    ->boolean()
                    ->label('Home Office'),

                Tables\Columns\TextColumn::make('workplace')
                    ->label('Arbeitsort'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->label('Erstellt'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Kategorie'),

                Tables\Filters\SelectFilter::make('location')
                    ->relationship('location', 'name')
                    ->label('Ort'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit'   => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}
