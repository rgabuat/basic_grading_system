<?php

namespace App\Filament\Resources\SubjectsResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\GradingPeriod;
use App\Models\Requirements;
use Illuminate\Http\Request;

class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'Activities';

    protected static ?string $recordTitleAttribute = 'subjects_id';

    

    public static function form(Form $form, Request $request = null): Form
    {


        return $form
            ->schema([
                Forms\Components\Select::make('grading_periods_id')
                            ->label('Course')
                            ->options(GradingPeriod::all()->pluck('name', 'id')),
                // Forms\Components\Select::make('requirements_id')
                //             ->label('Course')
                //             ->options(function(callable $get){
                //                 Requirements::where('subjects_idd', $get('subjects_id'))->pluck('name', 'id');

                //             }
                //             ),
                Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subjects_id'),
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
