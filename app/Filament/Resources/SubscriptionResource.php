<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Subscription;
use App\Filament\Traits\HasPermissionBasedAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class SubscriptionResource extends Resource
{
    use HasPermissionBasedAccess;
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Subscription Info')
                    ->schema([
                        Forms\Components\Placeholder::make('user')
                            ->label('User')
                            ->content(fn (?Subscription $record): string => $record?->user?->name ?? '-'),
                        Forms\Components\Placeholder::make('service')
                            ->label('Service')
                            ->content(fn (?Subscription $record): string => $record?->servicePlan?->service?->title ?? '-'),
                        Forms\Components\Placeholder::make('plan')
                            ->label('Plan')
                            ->content(fn (?Subscription $record): string => $record?->servicePlan?->name ?? '-'),
                        Forms\Components\Placeholder::make('status')
                            ->label('Status')
                            ->content(fn (?Subscription $record): string => ucfirst($record?->status ?? '-')),
                        Forms\Components\Placeholder::make('current_period_end')
                            ->label('Billing Period')
                            ->content(fn (?Subscription $record): string =>
                                $record?->current_period_start && $record?->current_period_end
                                    ? $record->current_period_start->format('M d, Y') . ' — ' . $record->current_period_end->format('M d, Y')
                                    : '-'),
                        Forms\Components\Placeholder::make('trial_ends_at')
                            ->label('Trial Ends')
                            ->content(fn (?Subscription $record): string => $record?->trial_ends_at?->format('M d, Y') ?? '-'),
                    ])->columns(3),

                Forms\Components\Section::make('Actions')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'trial' => 'Trial',
                                'suspended' => 'Suspended',
                                'cancelled' => 'Cancelled',
                                'expired' => 'Expired',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('status_reason')
                            ->label('Reason for status change')
                            ->rows(2),
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
                    ->sortable()
                    ->limit(25),
                Tables\Columns\TextColumn::make('servicePlan.name')
                    ->label('Plan')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'trial' => 'warning',
                        'suspended' => 'danger',
                        'cancelled' => 'gray',
                        'expired' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('billing_interval_label')
                    ->label('Interval'),
                Tables\Columns\IconColumn::make('is_overdue')
                    ->label('Overdue')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_period_end')
                    ->label('Next Billing')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Started')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'trial' => 'Trial',
                        'suspended' => 'Suspended',
                        'cancelled' => 'Cancelled',
                        'expired' => 'Expired',
                    ]),
                Tables\Filters\TernaryFilter::make('is_overdue')
                    ->label('Overdue Status')
                    ->queries(
                        true: fn ($query) => $query->overdue(),
                        false: fn ($query) => $query->where(fn ($q) => $q->where('current_period_end', '>=', now())->orWhereNull('current_period_end')),
                    ),
            ])
            ->actions([
                Tables\Actions\Action::make('suspend')
                    ->label('Suspend')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->visible(fn (Subscription $record): bool => $record->is_active)
                    ->action(function (Subscription $record, array $data) {
                        $record->update(['status' => 'suspended']);
                        $record->suspensionLogs()->create([
                            'action' => 'suspended',
                            'reason' => $data['reason'] ?? null,
                            'acted_by' => auth()->id(),
                        ]);
                        Notification::make()->title('Subscription suspended.')->success()->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Suspend Subscription')
                    ->form([
                        Forms\Components\Textarea::make('reason')->label('Reason')->rows(2),
                    ]),
                Tables\Actions\Action::make('activate')
                    ->label('Activate')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Subscription $record): bool => $record->status === 'suspended')
                    ->action(function (Subscription $record, array $data) {
                        $record->update(['status' => 'active']);
                        $record->suspensionLogs()->create([
                            'action' => 'activated',
                            'reason' => $data['reason'] ?? null,
                            'acted_by' => auth()->id(),
                        ]);
                        Notification::make()->title('Subscription activated.')->success()->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Activate Subscription')
                    ->form([
                        Forms\Components\Textarea::make('reason')->label('Reason')->rows(2),
                    ]),
                Tables\Actions\Action::make('cancel')
                    ->label('Cancel')
                    ->icon('heroicon-o-x-circle')
                    ->color('gray')
                    ->visible(fn (Subscription $record): bool => in_array($record->status, ['active', 'trial', 'suspended']))
                    ->action(function (Subscription $record) {
                        $record->update(['status' => 'cancelled', 'cancelled_at' => now()]);
                        $record->suspensionLogs()->create([
                            'action' => 'cancelled',
                            'acted_by' => auth()->id(),
                        ]);
                        Notification::make()->title('Subscription cancelled.')->success()->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Cancel Subscription'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSubscriptions::route('/'),
        ];
    }
}
