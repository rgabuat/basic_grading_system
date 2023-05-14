<?php

namespace App\Filament\Resources\TeacherSubjectsResource\Pages;

use App\Filament\Resources\TeacherSubjectsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeacherSubjects extends EditRecord
{
    protected static string $resource = TeacherSubjectsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
