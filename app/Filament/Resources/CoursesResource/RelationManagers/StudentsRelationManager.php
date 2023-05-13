<?php

namespace App\Filament\Resources\CoursesResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Year_levels;
use App\Models\Semesters;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    protected static ?string $recordTitleAttribute = 'email';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Fieldset::make('Enrollment Details')
                        ->schema([
                            Forms\Components\Select::make('year_level_id')
                                ->label('Year Level')
                                ->options(Year_levels::all()->pluck('name', 'id')),
                            Forms\Components\Select::make('semester_id')
                                ->label('Semester')
                                ->options(Semesters::all()->pluck('name', 'id')),
                        ])->columns(3),
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
                        ])->columns(3),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lname')->label('Last Name'),
                Tables\Columns\TextColumn::make('fname')->label('First Name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
