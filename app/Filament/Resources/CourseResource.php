<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers\LecturesRelationManager;
use App\Filament\Resources\CourseResource\RelationManagers\SectionsRelationManager;
use App\Models\Course;
use App\Filament\Traits\HasPermissionBasedAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    use HasPermissionBasedAccess;
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'LMS';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', str()->slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('user_id')
                            ->label('Instructor')
                            ->relationship('instructor', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('short_description')
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('long_description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('BDT')
                            ->required()
                            ->default(0),
                        Forms\Components\TextInput::make('discount_price')
                            ->numeric()
                            ->prefix('BDT'),
                        Forms\Components\Toggle::make('is_free')
                            ->inline(false),
                    ])->columns(3),

                Forms\Components\Section::make('Media & Settings')
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->directory('courses'),
                        Forms\Components\Select::make('level')
                            ->options([
                                'all' => 'All Levels',
                                'beginner' => 'Beginner',
                                'intermediate' => 'Intermediate',
                                'advanced' => 'Advanced',
                            ])
                            ->default('all'),
                        Forms\Components\TextInput::make('duration')
                            ->label('Duration (minutes)')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_featured')
                            ->inline(false),
                        Forms\Components\Toggle::make('is_published')
                            ->inline(false),
                    ])->columns(3),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description'),
                    ])->columns(2),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Overview')
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('instructor.name')->label('Instructor'),
                        TextEntry::make('category.name')->label('Category'),
                        TextEntry::make('price')->money('BDT'),
                        TextEntry::make('discount_price')->money('BDT'),
                        TextEntry::make('level')->badge(),
                        TextEntry::make('duration_formatted')->label('Duration'),
                        TextEntry::make('sections_count')
                            ->state(fn (Course $record) => $record->sections()->count())
                            ->label('Sections'),
                        IconEntry::make('is_published')->boolean(),
                        IconEntry::make('is_featured')->boolean(),
                        IconEntry::make('is_free')->boolean(),
                    ])->columns(3),

                Section::make('Description')
                    ->schema([
                        TextEntry::make('short_description'),
                        TextEntry::make('long_description')
                            ->html()
                            ->columnSpanFull(),
                    ]),

                Section::make('Curriculum')
                    ->schema([
                        RepeatableEntry::make('sections')
                            ->schema([
                                TextEntry::make('title'),
                                TextEntry::make('lectures_count')
                                    ->state(fn ($record) => $record->lectures()->count())
                                    ->label('Lectures'),
                                RepeatableEntry::make('lectures')
                                    ->schema([
                                        TextEntry::make('title'),
                                        TextEntry::make('duration')
                                            ->formatStateUsing(fn ($state) => gmdate('i:s', $state)),
                                        IconEntry::make('is_free')->boolean(),
                                    ])
                                    ->columns(3),
                            ])
                            ->columns(2),
                    ]),
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
                Tables\Columns\TextColumn::make('instructor.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.typeRel.name')
                    ->label('Category Type')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price')
                    ->money('BDT')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'beginner' => 'success',
                        'intermediate' => 'warning',
                        'advanced' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('enrollments_count')
                    ->counts('enrollments')
                    ->sortable()
                    ->label('Enrolled'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('level')
                    ->options([
                        'all' => 'All Levels',
                        'beginner' => 'Beginner',
                        'intermediate' => 'Intermediate',
                        'advanced' => 'Advanced',
                    ]),
                Tables\Filters\TernaryFilter::make('is_published'),
                Tables\Filters\TernaryFilter::make('is_featured'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SectionsRelationManager::class,
            LecturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
