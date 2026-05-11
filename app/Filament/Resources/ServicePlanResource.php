<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicePlanResource\Pages;
use App\Models\ServicePlan;
use App\Filament\Traits\HasPermissionBasedAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServicePlanResource extends Resource
{
    use HasPermissionBasedAccess;
    protected static ?string $model = ServicePlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Plan Details')
                    ->schema([
                        Forms\Components\Select::make('service_id')
                            ->relationship('service', 'title')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', str()->slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(1000),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('delivery_time')
                            ->maxLength(100)
                            ->placeholder('e.g. 5-7 days'),
                        Forms\Components\Repeater::make('features')
                            ->schema([
                                Forms\Components\TextInput::make('feature')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->defaultItems(3)
                            ->addActionLabel('Add Feature')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->inline(false),
                        Forms\Components\Toggle::make('is_popular')
                            ->label('Mark as Popular')
                            ->helperText('Recommended/popular plan badge on the frontend.')
                            ->inline(false),
                        Forms\Components\Toggle::make('is_subscription')
                            ->label('Subscription Plan')
                            ->helperText('Enable for recurring billing (monthly/yearly).')
                            ->live()
                            ->inline(false)
                            ->afterStateUpdated(fn (Forms\Set $set, bool $state) => $state ? null : $set('billing_interval', null)),
                        Forms\Components\Select::make('billing_interval')
                            ->label('Billing Interval')
                            ->options([
                                'monthly' => 'Monthly',
                                'yearly' => 'Yearly',
                                'quarterly' => 'Quarterly',
                            ])
                            ->visible(fn (Forms\Get $get): bool => (bool) $get('is_subscription')),
                        Forms\Components\TextInput::make('trial_days')
                            ->label('Trial Period (days)')
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('0 = no trial')
                            ->visible(fn (Forms\Get $get): bool => (bool) $get('is_subscription')),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service.title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_time')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_subscription')
                    ->label('Subscription')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('billing_interval')
                    ->label('Interval')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_popular')
                    ->label('Popular')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
                Tables\Filters\SelectFilter::make('service_id')
                    ->relationship('service', 'title'),
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
            'index' => Pages\ManageServicePlans::route('/'),
        ];
    }
}
