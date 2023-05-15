<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivitiesResource\Pages;
use App\Filament\Resources\ActivitiesResource\RelationManagers;
use App\Models\Activities;
use App\Models\User;
use App\Models\Grades;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivitiesResource extends Resource
{
    protected static ?string $model = Activities::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('Teachers')
                    ->options(User::all()->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
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
            'index' => Pages\ListActivities::route('/'),
            // 'create' => Pages\CreateActivities::route('/create'),
            // 'edit' => Pages\EditActivities::route('/{record}/edit'),
        ];
    }    
}
