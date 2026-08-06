<?php

namespace App\Filament\Resources\SectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LecturesRelationManager extends RelationManager
{
    protected static string $relationship = 'lectures';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', str()->slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('content')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('video_url')
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('duration')
                    ->label('Duration (seconds)')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_free')
                    ->label('Free Preview'),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('duration')
                    ->formatStateUsing(fn ($state) => gmdate('i:s', $state))
                    ->sortable()
                    ->label('Duration'),
                Tables\Columns\IconColumn::make('is_free')
                    ->boolean()
                    ->sortable()
                    ->label('Free'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
