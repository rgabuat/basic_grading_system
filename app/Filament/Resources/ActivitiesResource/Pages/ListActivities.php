<?php

namespace App\Filament\Resources\ActivitiesResource\Pages;

use App\Filament\Resources\ActivitiesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivitiesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
