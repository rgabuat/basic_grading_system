<?php

namespace App\Filament\Resources\SubjectsResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Grades;
use App\Models\Students;
use App\Models\Activities;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Livewire\Component as Livewire;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class GradesRelationManager extends RelationManager
{
    protected static string $relationship = 'Grades';

    protected static ?string $recordTitleAttribute = 'subjects_id';

    public static function form(Form $form): Form
    {
        $test = '';
        return $form
            ->schema([
                Forms\Components\Select::make('students_id')
                            ->label('Students')
                            ->options(function (Livewire $livewire)
                                    {
                                        return Students::where('courses_id',$livewire->ownerRecord->courses_id)->pluck('fname', 'id');
                                    }
                                    )

                            ->reactive()
                            ->afterStateUpdated(fn(callable $set) => $set('activity_id',null)),
                Forms\Components\Select::make('activity_id')
                            ->label('Activities')
                            ->options(function (callable $get, Livewire $livewire){
                                $student = Students::find($get('students_id'));
                                        if($student)
                                        {
                                                return Activities::whereNotIn('id',function($query) use ($student,$livewire) {
                                                    $query->select('activity_id')
                                                        ->from('grades')
                                                        ->where('subjects_id',$livewire->ownerRecord->id)
                                                        ->where('students_id',$student->id);
                                                })->where('subjects_id',$livewire->ownerRecord->id)->pluck('name','id');
                                        }
                                        else 
                                        {
                                            return Activities::where('subjects_id',$livewire->ownerRecord->id)->pluck('name', 'id');
                                        }
                                })
                                ->reactive()
                                ->afterStateUpdated(fn(callable $set) => $set('score',null)),
                Forms\Components\TextInput::make('score')
                            ->maxValue(function (callable $get)
                                {
                                    $activity = Activities::find($get('activity_id'));

                                    if($activity)
                                    {
                                        return $activity->total;
                                    }
                                   
                                    
                                }
                            )
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
