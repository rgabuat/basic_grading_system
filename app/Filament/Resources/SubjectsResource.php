<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectsResource\Pages;
use App\Filament\Resources\SubjectsResource\RelationManagers;
use App\Models\Subjects;
use Spatie\Permission\Models\Role;
use App\Models\Courses;
use App\Models\User;
use App\Models\Year_levels;
use App\Models\Semesters;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
class SubjectsResource extends Resource
{

    protected static ?string $model = Subjects::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationGroup = 'Courses';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('courses_id')
                    ->label('Course')
                    ->options(Courses::all()->pluck('name', 'id')),
                Forms\Components\Select::make('year_level_id')
                    ->label('Year Level')
                    ->options(Year_levels::all()->pluck('name', 'id')),
                Forms\Components\Select::make('semester_id')
                    ->label('Semester')
                    ->options(Semesters::all()->pluck('name', 'id')),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    
    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()
                    ->label('Subject'),
                Tables\Columns\TextColumn::make('code')->searchable()->sortable()
                    ->label('Code'),
                Tables\Columns\TextColumn::make('created_at')->searchable()->sortable()
                    ->since(),
                Tables\Columns\TextColumn::make('updated_at')->searchable()->sortable()
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('View Students')
                    ->color('success')
                    ->icon('heroicon-s-view-list')
                    ->url(fn (Subjects $record): string => route('filament.resources.subjects.students', $record))


            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\RequirementsRelationManager::class,
            RelationManagers\ActivitiesRelationManager::class,
            RelationManagers\GradesRelationManager::class,


        ];
    }

    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'students' => Pages\StudentSubjects::route('/student/{record}'),
            'subjects' => Pages\ListSubjects::route('/{record}'), 
            'view' => Pages\ViewSubject::route('/{record}'),


           // 'create' => Pages\CreateSubjects::route('/create'),
            //'edit' => Pages\EditSubjects::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder 
    {
        $query = parent::getEloquentQuery();

        if (Auth::check() && Auth::user()->hasRole('admin')) {
            // The user has the admin role
        } else {
            $query->whereHas('TeacherSubject', function ($query1) {
                $query1->where('user_id', auth()->user()->id );
            });
        }
        return $query;
    }

    
   
}
