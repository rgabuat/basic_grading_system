<?php

namespace App\Filament\Resources\SubjectsResource\Pages;

use App\Filament\Resources\SubjectsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubjects extends CreateRecord
{
    protected static string $resource = SubjectsResource::class;
    
    protected function getRedirectUrl():string 
    {
        return route(name:'filament.resources.courses.index');
    }

    protected function getCreatedNotificationTitle(): ?string 
    {
        return 'Subject Successfully Added';
    }
}
