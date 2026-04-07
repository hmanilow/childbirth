<?php

namespace App\Filament\Resources\PriceItems\Pages;

use App\Filament\Resources\PriceItems\PriceItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePriceItems extends ManageRecords
{
    protected static string $resource = PriceItemResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
