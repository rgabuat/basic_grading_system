<?php

namespace App\Filament\Resources\CoursesResource\Pages;

use App\Filament\Resources\CoursesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourses extends EditRecord
{
    protected static string $resource = CoursesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
