<?php

namespace App\Filament\Resources\SubjectsResource\Pages;

use App\Filament\Resources\SubjectsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubjects extends ListRecords
{
    protected static string $resource = SubjectsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
