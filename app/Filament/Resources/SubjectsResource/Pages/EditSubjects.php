<?php

namespace App\Filament\Resources\SubjectsResource\Pages;

use App\Filament\Resources\SubjectsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubjects extends EditRecord
{
    protected static string $resource = SubjectsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl():string 
    {
        return route(name:'filament.resources.courses.index');
    }

    protected function getCreatedNotificationTitle(): ?string 
    {
        return 'Subject Successfully Edited';
    }
}
