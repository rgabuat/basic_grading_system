<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectsResource\Pages;
use App\Filament\Resources\SubjectsResource\RelationManagers;
use App\Models\Subjects;
use App\Models\Courses;
use App\Models\Year_levels;
use App\Models\Semesters;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectsResource extends Resource
{
    protected static ?string $model = Subjects::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationGroup = 'Courses';
    protected static ?int $navigationSort = 2;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('courses_id')
                    ->label('Course')
                    ->options(Courses::all()->pluck('name', 'id')),
                Forms\Components\Select::make('year_level_id')
                    ->label('Year Level')
                    ->options(Year_levels::all()->pluck('name', 'id')),
                Forms\Components\Select::make('semester_id')
                    ->label('Semester')
                    ->options(Semesters::all()->pluck('name', 'id')),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('course'),
                Tables\Columns\TextColumn::make('created_at')
                ->since(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'subjects' => Pages\ListSubjects::route('/{record}'), 
            // 'create' => Pages\CreateSubjects::route('/create'),
            //'edit' => Pages\EditSubjects::route('/{record}/edit'),
        ];
    }
    
   
}
