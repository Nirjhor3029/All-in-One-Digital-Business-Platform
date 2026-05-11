<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LectureResource\Pages;
use App\Models\Lecture;
use App\Filament\Traits\HasPermissionBasedAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LectureResource extends Resource
{
    use HasPermissionBasedAccess;
    protected static ?string $model = Lecture::class;

    protected static ?string $navigationIcon = 'heroicon-o-play';

    protected static ?string $navigationGroup = 'LMS';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Lecture Details')
                    ->schema([
                        Forms\Components\Select::make('section_id')
                            ->relationship('section', 'title', fn (Builder $query) => $query->with('course'))
                            ->getOptionLabelFromRecordUsing(fn ($record) => "[{$record->course->title}] {$record->title}")
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', str()->slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ])->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Video')
                    ->schema([
                        Forms\Components\TextInput::make('video_url')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://player.vimeo.com/video/...'),
                        Forms\Components\Select::make('video_provider')
                            ->options([
                                'youtube' => 'YouTube',
                                'vimeo' => 'Vimeo',
                                'bunny' => 'Bunny.net',
                                'custom' => 'Custom URL',
                            ]),
                        Forms\Components\TextInput::make('duration')
                            ->label('Duration (seconds)')
                            ->numeric()
                            ->default(0)
                            ->helperText('Video length in seconds'),
                    ])->columns(3),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_free')
                            ->label('Free Preview')
                            ->inline(false)
                            ->helperText('Allow non-enrolled users to preview this lecture'),
                        Forms\Components\TagsInput::make('attachments')
                            ->placeholder('Add attachment URL'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('section.course.title')
                    ->searchable()
                    ->sortable()
                    ->limit(25)
                    ->label('Course'),
                Tables\Columns\TextColumn::make('section.title')
                    ->searchable()
                    ->limit(25)
                    ->label('Section'),
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
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('section_id', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('section_id')
                    ->label('Section')
                    ->relationship('section', 'title')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_free')
                    ->label('Free Preview'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLectures::route('/'),
            'create' => Pages\CreateLecture::route('/create'),
            'edit' => Pages\EditLecture::route('/{record}/edit'),
        ];
    }
}
