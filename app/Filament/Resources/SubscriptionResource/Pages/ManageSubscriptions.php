<?php

namespace App\Filament\Resources\SubscriptionResource\Pages;

use App\Filament\Resources\SubscriptionResource;
use Filament\Resources\Pages\ManageRecords;

class ManageSubscriptions extends ManageRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
