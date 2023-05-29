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
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component as Livewire;
use Filament\Tables\Filters\SelectFilter;

class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'Activities';

    protected static ?string $recordTitleAttribute = 'subjects_id';

    

    public static function form(Form $form, Request $request = null): Form
    {
         


 
        return $form
            ->schema([
                Forms\Components\Select::make('grading_periods_id')
                            ->label('Grading')
                            ->options(GradingPeriod::all()->pluck('name', 'id')),
                Forms\Components\Select::make('requirements_id')
                            ->label('Requirement')
                            ->options(function (Livewire $livewire)
                                {
                                    return Requirements::where('subjects_id',$livewire->ownerRecord->id)->pluck('name', 'id');
                                }
                            ),
                Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                Forms\Components\TextInput::make('total')
                            ->required()
                            ->numeric()
                            ->maxLength(255),
            ]);

            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('total')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('requirements.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('gradingPeriod.name')->searchable()->sortable(),
            ])
            ->filters([
                SelectFilter::make('requirements_id')
                ->options(function (Livewire $livewire)
                {
                    return Requirements::where('subjects_id',$livewire->ownerRecord->id)->pluck('name', 'id');
                })
                ->attribute('requirements_id'),

                SelectFilter::make('grading_periods_id')
                ->options(function (Livewire $livewire)
                {
                    return GradingPeriod::pluck('name', 'id');
                })
                ->attribute('grading_periods_id')
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
