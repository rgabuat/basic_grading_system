<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Courses;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void {
        
        Courses::create([
            'name' => 'test',
            'abbv' => 'ss',
        ]);

    }

    protected function handleRecordUpdate(Students $record, array $data): Students
{
    $record->update($data);
 
    return $record;
}
}
