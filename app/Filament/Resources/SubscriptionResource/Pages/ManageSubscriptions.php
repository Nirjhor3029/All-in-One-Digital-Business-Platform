<?php

namespace App\Filament\Resources\SubscriptionResource\Pages;

use App\Filament\Resources\SubscriptionResource;
use App\Models\ServicePlan;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ManageRecords;

class ManageSubscriptions extends ManageRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalHeading('Create Subscription')
                ->form([
                    Forms\Components\Select::make('user_id')
                        ->label('User')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->required(),
                    Forms\Components\Select::make('service_plan_id')
                        ->label('Service Plan')
                        ->options(fn () => ServicePlan::where('is_subscription', true)->with('service')->get()
                            ->mapWithKeys(fn ($plan) => [
                                $plan->id => ($plan->service?->title ?? '?') . ' — ' . $plan->name . ' ($' . number_format($plan->price, 2) . '/' . $plan->billing_interval . ')'
                            ]))
                        ->searchable()
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->options([
                            'active' => 'Active',
                            'trial' => 'Trial',
                            'suspended' => 'Suspended',
                            'cancelled' => 'Cancelled',
                            'expired' => 'Expired',
                        ])
                        ->default('active')
                        ->required(),
                    Forms\Components\DateTimePicker::make('trial_ends_at')
                        ->label('Trial Ends At')
                        ->native(false),
                    Forms\Components\DateTimePicker::make('current_period_start')
                        ->label('Period Start')
                        ->default(now())
                        ->native(false),
                    Forms\Components\DateTimePicker::make('current_period_end')
                        ->label('Period End (Next Billing)')
                        ->native(false),
                ])
                ->mutateFormDataUsing(function (array $data): array {
                    $plan = ServicePlan::find($data['service_plan_id']);
                    if ($plan && empty($data['current_period_end'])) {
                        $start = $data['current_period_start'] ?? now();
                        $data['current_period_end'] = match ($plan->billing_interval) {
                            'yearly' => \Carbon\Carbon::parse($start)->addYear(),
                            'quarterly' => \Carbon\Carbon::parse($start)->addMonths(3),
                            default => \Carbon\Carbon::parse($start)->addMonth(),
                        };
                    }
                    if (empty($data['current_period_start'])) {
                        $data['current_period_start'] = now();
                    }
                    $data['order_id'] = null;
                    return $data;
                }),
        ];
    }
}
