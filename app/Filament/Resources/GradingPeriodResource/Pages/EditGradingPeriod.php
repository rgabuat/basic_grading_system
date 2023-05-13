<?php

namespace App\Filament\Resources\GradingPeriodResource\Pages;

use App\Filament\Resources\GradingPeriodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGradingPeriod extends EditRecord
{
    protected static string $resource = GradingPeriodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
