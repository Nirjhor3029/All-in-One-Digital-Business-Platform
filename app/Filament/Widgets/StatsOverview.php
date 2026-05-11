<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
                ->description('Total registered users')
                ->descriptionIcon('heroicon-o-users')
                ->color('info'),

            Stat::make('Active Users', User::where('is_active', true)->count())
                ->description('Currently active accounts')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Admins', User::where('role', 'admin')->count())
                ->description('Administrator accounts')
                ->descriptionIcon('heroicon-o-shield-check')
                ->color('warning'),
        ];
    }
}
