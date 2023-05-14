<?php

namespace App\Filament\Resources\GradesResource\Pages;

use App\Filament\Resources\GradesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGrades extends EditRecord
{
    protected static string $resource = GradesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
