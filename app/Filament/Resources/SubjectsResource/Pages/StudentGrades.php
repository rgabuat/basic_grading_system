<?php

namespace App\Filament\Resources\SubjectsResource\Pages;

use App\Filament\Resources\SubjectsResource;
use Filament\Resources\Pages\Page;

class StudentGrades extends Page
{
    protected static string $resource = SubjectsResource::class;

    protected static string $view = 'filament.resources.subjects-resource.pages.student-grades';
    
}
