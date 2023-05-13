<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentsResource\Pages;
use App\Filament\Resources\StudentsResource\RelationManagers;
use App\Models\Students;
use App\Models\Courses;
use App\Models\Year_levels;
use App\Models\Semesters;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentsResource extends Resource
{
    protected static ?string $model = Students::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Fieldset::make('Student Information')
                            ->schema([
                            
                            Forms\Components\TextInput::make('fname')
                                ->label('First Name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('lname')
                                ->label('Last Name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('mname')
                                ->label('Middle Name')
                                ->maxLength(255),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('phone_number')
                                ->tel()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                            ])
                            ->required(),
                            Forms\Components\DatePicker::make('dob')
                            ->format('Y-m-d')
                            ->required(),
                            Forms\Components\TextInput::make('address')
                                ->required()
                                ->maxLength(255),
                        
                        ])
                        ->columns(3),
                        Forms\Components\Fieldset::make('Guardian Information')
                            ->schema([
                                Forms\Components\TextInput::make('parent_name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('parent_email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('parent_address')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('parent_phone_number')
                                ->tel()
                                ->required()
                                ->maxLength(255),
                        ])
                        ->columns(3)
                    ])->columns(3),
                    Forms\Components\Fieldset::make('Enrollment Details')
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
                        ])->columns(3)->relationship("studentSemester")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('studentSemester.courses.name'),
                Tables\Columns\TextColumn::make('lname')->label('Last Name'),
                Tables\Columns\TextColumn::make('fname')->label('First Name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('id')
                ->options(Courses::all()->pluck('name', 'id')),
                
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
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudents::route('/create'),
            'edit' => Pages\EditStudents::route('/{record}/edit'),
        ];
    }    
}
