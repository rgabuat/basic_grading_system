<?php

namespace App\Filament\Resources\YearLevelsResource\Pages;

use App\Filament\Resources\YearLevelsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditYearLevels extends EditRecord
{
    protected static string $resource = YearLevelsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
