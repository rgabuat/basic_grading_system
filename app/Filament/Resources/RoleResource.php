<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use Spatie\Permission\Models\Role;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-finger-print';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                    ->minLength(2)
                    ->maxLength(255)
                    ->required()
                    ->unique(ignoreRecord:true),
                Select::make('permissions')
                    ->multiple()
                    ->relationship('permissions','name')
                    ->preload()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make(name:'id')
                        ->searchable()
                        ->sortable(),
                TextColumn::make(name:'name')
                        ->searchable()
                        ->sortable(),
                TextColumn::make(name:'guard_name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\PermissionsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            // 'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }    
}
