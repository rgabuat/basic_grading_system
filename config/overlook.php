<?php

return [
    'includes' => [
        App\Filament\Resources\StudentsResource::class,
        App\Filament\Resources\CoursesResource::class,
        App\Filament\Resources\SemestersResource::class,
        App\Filament\Resources\SubjectsResource::class,
        App\Filament\Resources\UserResource::class,


    ],
    'excludes' => [
        // App\Filament\Resources\Blog\AuthorResource::class,
    ],
];
