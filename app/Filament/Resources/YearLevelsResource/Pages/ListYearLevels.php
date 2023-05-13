<?php

namespace App\Filament\Resources\YearLevelsResource\Pages;

use App\Filament\Resources\YearLevelsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYearLevels extends ListRecords
{
    protected static string $resource = YearLevelsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
