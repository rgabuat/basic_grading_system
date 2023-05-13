<?php

namespace App\Filament\Resources\SemestersResource\Pages;

use App\Filament\Resources\SemestersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSemesters extends ListRecords
{
    protected static string $resource = SemestersResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
