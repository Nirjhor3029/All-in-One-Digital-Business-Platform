<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicePurchaseResource\Pages;
use App\Models\ServicePurchase;
use App\Filament\Traits\HasPermissionBasedAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ServicePurchaseResource extends Resource
{
    use HasPermissionBasedAccess;
    protected static ?string $model = ServicePurchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Purchase Info')
                    ->schema([
                        Forms\Components\Placeholder::make('user')
                            ->label('User')
                            ->content(fn (?ServicePurchase $record): string => $record?->user?->name ?? '-'),
                        Forms\Components\Placeholder::make('service')
                            ->label('Service')
                            ->content(fn (?ServicePurchase $record): string => $record?->servicePlan?->service?->title ?? '-'),
                        Forms\Components\Placeholder::make('plan')
                            ->label('Plan')
                            ->content(fn (?ServicePurchase $record): string => $record?->servicePlan?->name ?? '-'),
                        Forms\Components\Placeholder::make('status')
                            ->label('Status')
                            ->content(fn (?ServicePurchase $record): string => $record?->status ?? '-'),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Purchased At')
                            ->content(fn (?ServicePurchase $record): string => $record?->created_at?->format('M d, Y g:i A') ?? '-'),
                    ])->columns(3),

                Forms\Components\Section::make('Delivery Details')
                    ->schema([
                        Forms\Components\TextInput::make('download_url')
                            ->label('Download URL')
                            ->url()
                            ->placeholder('https://example.com/download/abc123')
                            ->columnSpan(1),
                        Forms\Components\DateTimePicker::make('delivered_at')
                            ->label('Delivered At')
                            ->native(false)
                            ->columnSpan(1),
                        Forms\Components\Textarea::make('credentials')
                            ->label('Credentials / Login Info')
                            ->placeholder('Username: admin@example.com' . PHP_EOL . 'Password: temp1234')
                            ->rows(4)
                            ->columnSpan(1),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes (internal)')
                            ->rows(4)
                            ->columnSpan(1),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('servicePlan.service.title')
                    ->label('Service')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('servicePlan.name')
                    ->label('Plan'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'expired' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('is_delivered')
                    ->label('Delivered')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivered_at')
                    ->label('Delivered At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Purchased')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'expired' => 'Expired',
                    ]),
                Tables\Filters\TernaryFilter::make('delivered_at')
                    ->label('Delivery Status')
                    ->nullable()
                    ->placeholder('All')
                    ->trueLabel('Delivered')
                    ->falseLabel('Pending'),
            ])
            ->actions([
                Tables\Actions\Action::make('markDelivered')
                    ->label('Mark Delivered')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (ServicePurchase $record): bool => ! $record->is_delivered)
                    ->action(function (ServicePurchase $record) {
                        $record->update([
                            'delivered_at' => now(),
                            'delivered_by' => auth()->id(),
                        ]);
                        Notification::make()
                            ->title('Service marked as delivered.')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Mark Delivered')
                    ->modalDescription('This will mark the service as delivered to the user.'),
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
            'index' => Pages\ManageServicePurchases::route('/'),
        ];
    }
}
