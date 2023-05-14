<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Subjects;


class TeacherSubjectRelationManager extends RelationManager
{
    protected static string $relationship = 'TeacherSubject';

    protected static ?string $recordTitleAttribute = 'user_id';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('subject_id')
                                ->label('Subject')
                                ->options(function (?Model $record){

                                    $id = $record;
                                    Subjects::whereNotIn('id', function ($query) use ($id) {
                                        $query->select('subject_id')
                                              ->from('teacher_subjects')
                                              ->where('user_id','test',$id);
                                            })->get();
                                })
                            ]);

           
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
