<?php

namespace App\Filament\Resources\CityLandingPages\Pages;

use App\Filament\Resources\CityLandingPages\CityLandingPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCityLandingPages extends ManageRecords
{
    protected static string $resource = CityLandingPageResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
