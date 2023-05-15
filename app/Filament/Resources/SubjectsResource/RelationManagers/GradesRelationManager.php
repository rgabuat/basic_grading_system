<?php

namespace App\Filament\Resources\SubjectsResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Students;
use App\Models\Activities;
use Livewire\Component as Livewire;
class GradesRelationManager extends RelationManager
{
    protected static string $relationship = 'Grades';

    protected static ?string $recordTitleAttribute = 'subjects_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('students_id')
                            ->label('Students')
                            ->options(function (Livewire $livewire)
                                {
                                    return Students::where('courses_id',$livewire->ownerRecord->courses_id)->pluck('fname', 'id');
                                }
                            ),
                Forms\Components\Select::make('activity_id')
                            ->label('Activities')
                            ->options(function (Livewire $livewire)
                                {
                                    return activities::where('subjects_id',$livewire->ownerRecord->id)->pluck('name', 'id');
                                }
                            ),
                Forms\Components\TextInput::make('score')
                            ->required()
                            ->numeric()
                            ->maxLength(255),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.lname'),
                Tables\Columns\TextColumn::make('activity.name'),
                Tables\Columns\TextColumn::make('score'),
                Tables\Columns\TextColumn::make('activity.total'),
                Tables\Columns\TextColumn::make('activity.gradingPeriod.name'),




            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
