<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
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
                Forms\Components\Select::make('subjects_id')
                                ->label('Subject')
                                ->options(Subjects::whereNotIn('id', function($query) {
                                    $query->select('subjects_id')
                                          ->from('teacher_subjects');
                                })->pluck('name', 'id')),
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
