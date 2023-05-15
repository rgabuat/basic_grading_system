<?php

namespace App\Filament\Resources\SubjectsResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Requirements;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Livewire\Component as Livewire;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class RequirementsRelationManager extends RelationManager
{
    protected static string $relationship = 'Requirements';

    protected static ?string $recordTitleAttribute = 'subjects_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('percentage')
                    ->lte(function (callable $get)
                        {
                            
                                $current = $get('percentage');
                                $total = 0;

                                $requirements = Requirements::where('subjects_id',2)->get();
                                if($requirements->count() > 0)
                                {
                                    $subval = $requirements->sum('percentage');
                                    $total = $subval;
                                }
                                
                                $val = $current + $total;
                                if($val > 100)
                                {
                                    return 100;
                                }        
                        })
                    ->numeric()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                        ->searchable()
                        ->sortable(),
                Tables\Columns\TextColumn::make('percentage')
                        ->searchable()
                        ->sortable(),
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
