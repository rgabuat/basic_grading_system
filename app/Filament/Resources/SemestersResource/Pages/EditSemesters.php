<?php

namespace App\Filament\Resources\SemestersResource\Pages;

use App\Filament\Resources\SemestersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSemesters extends EditRecord
{
    protected static string $resource = SemestersResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
