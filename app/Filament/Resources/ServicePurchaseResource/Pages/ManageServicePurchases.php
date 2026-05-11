<?php

namespace App\Filament\Resources\ServicePurchaseResource\Pages;

use App\Filament\Resources\ServicePurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageServicePurchases extends ManageRecords
{
    protected static string $resource = ServicePurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
