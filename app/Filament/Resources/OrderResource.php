<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Filament\Traits\HasPermissionBasedAccess;
use App\Services\OrderService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    use HasPermissionBasedAccess;
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Order Information')
                    ->schema([
                        Forms\Components\TextInput::make('order_number')
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                                'refunded' => 'Refunded',
                            ])
                            ->required(),
                        Forms\Components\Select::make('payment_status')
                            ->options([
                                'unpaid' => 'Unpaid',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('subtotal')
                            ->disabled()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('discount')
                            ->disabled()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('total')
                            ->disabled()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\Textarea::make('notes')
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('Order Items')
                    ->schema([
                        Forms\Components\Placeholder::make('items_list')
                            ->label('Items')
                            ->content(function (?Order $record): string {
                                if (! $record || $record->items->isEmpty()) return 'No items';
                                return $record->items->map(function ($item) {
                                    $title = $item->itemable?->title ?? 'Unknown';
                                    $type = class_basename($item->itemable_type);
                                    $price = number_format($item->price, 2);
                                    return "- {$title} ({$type}) — \${$price}";
                                })->implode("\n");
                            })
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Billing Details')
                    ->schema([
                        Forms\Components\TextInput::make('billing_name')
                            ->disabled(),
                        Forms\Components\TextInput::make('billing_email')
                            ->disabled()
                            ->email(),
                        Forms\Components\TextInput::make('billing_phone')
                            ->disabled(),
                        Forms\Components\Textarea::make('billing_address')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->url(fn (Order $record): string => OrderResource::getUrl('edit', ['record' => $record])),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('items_list')
                    ->label('Items')
                    ->getStateUsing(function (Order $record): string {
                        return $record->items->map(fn ($item) => $item->itemable?->title ?? class_basename($item->itemable_type))->implode(', ');
                    })
                    ->limit(40)
                    ->tooltip(function (Order $record): ?string {
                        $items = $record->items->map(fn ($item) => $item->itemable?->title ?? 'Item')->implode("\n");
                        return $items ?: null;
                    }),
                Tables\Columns\TextColumn::make('total')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ]),
                Tables\Columns\SelectColumn::make('payment_status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ]),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('markPaid')
                    ->label('Confirm Payment')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Order $record): bool => $record->payment_status !== 'paid')
                    ->action(function (Order $record, OrderService $service) {
                        $service->markPaid($record);
                        Notification::make()
                            ->title('Payment confirmed — enrollments created.')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Payment')
                    ->modalDescription('This will mark the order as paid and enroll the user in their courses.'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
