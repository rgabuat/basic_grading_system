<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradesResource\Pages;
use App\Filament\Resources\GradesResource\RelationManagers;
use App\Models\Grades;
use App\Models\Activities;
use App\Models\Students;
use App\Models\GradingPeriod;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradesResource extends Resource
{
    protected static ?string $model = Grades::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Student')
                    ->options(Students::all()->pluck('fname', 'id'))
                    ->required(),
                Forms\Components\Select::make('activity_id')
                    ->label('Activity')
                    ->options(Activities::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\Select::make('grading_period_id')
                    ->label('Grading')
                    ->options(GradingPeriod::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('score'),
                Forms\Components\TextInput::make('total'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student_id'),
                Tables\Columns\TextColumn::make('activity_id'),
                Tables\Columns\TextColumn::make('grading_period_id'),
                Tables\Columns\TextColumn::make('score'),
                Tables\Columns\TextColumn::make('total'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListGrades::route('/'),
            // 'create' => Pages\CreateGrades::route('/create'),
            // 'edit' => Pages\EditGrades::route('/{record}/edit'),
        ];
    }    
}
