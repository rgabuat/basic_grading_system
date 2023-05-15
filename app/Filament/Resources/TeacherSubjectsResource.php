<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherSubjectsResource\Pages;
use App\Filament\Resources\TeacherSubjectsResource\RelationManagers;
use App\Models\TeacherSubject;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherSubjectsResource extends Resource
{
    protected static ?string $model = TeacherSubject::class;
    protected static ?string $navigationGroup = 'Courses';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                                ->label('Teachers')
                                ->options(User::all()->pluck('name', 'id')),
                Forms\Components\Select::make('subjects_id')
                                ->label('Subject')
                                ->options(Subjects::all()->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name'),
                Tables\Columns\TextColumn::make('teacher.email'),

                
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
            RelationManagers\RequirementsRelationManager::class,
            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeacherSubjects::route('/'),
            'create' => Pages\CreateTeacherSubjects::route('/create'),
            'edit' => Pages\EditTeacherSubjects::route('/{record}/edit'),

        ];
    }  
    
    public static function getEloquentQuery(): Builder 
    {
        $query = parent::getEloquentQuery();

        if (Auth::check() && Auth::user()->hasRole('admin')) {
            // The user has the admin role
        } else {
            $query->where('user_id', auth()->user()->id);
        }
        return $query;
    }
}
