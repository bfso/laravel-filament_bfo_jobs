<?php

namespace App\Filament\Resources\Positions\Tables;

use App\Models\Application;
use App\Models\Position;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PositionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title'),
                TextColumn::make('end'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(function ($record) {
                        return Filament::getCurrentOrDefaultPanel()?->getId() === 'admin';
                    }),
                Action::make('apply')
                    ->schema([
                        RichEditor::make('description')
                            ->columnSpanFull(),
                        FileUpload::make('document')
                            ->label('CV')
                            ->preserveFilenames()
                            ->acceptedFileTypes([
                                'image/png',
                                'application/pdf',
                                ])
                            ->required()
                            ->helperText('allowed file types are: pdf, png'),
                    ])
                    ->button()
                    ->action(function (Position $record, array $data) {
                        Application::create([
                            'position_id' => $record->id,
                            'user_id' => auth()->user()->id,
                            'description' => $data['description'],
                            'document' => $data['document'],
                        ]);

                        Notification::make('after_apply')
                            ->title('Application successful')
                            ->body('Thank you for applying!')
                            ->info()
                            ->send();
                    })
                    ->visible(function ($record) {
                        return Filament::getCurrentOrDefaultPanel()?->getId() !== 'admin';
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(function ($record) {
                            return Filament::getCurrentOrDefaultPanel()?->getId() === 'admin';
                        }),
                ]),
            ]);
    }
}
