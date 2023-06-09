<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Courses;
use App\Models\Students;
use App\Models\Semesters;
use App\Models\Year_levels;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentsResource\RelationManagers;

class StudentsResource extends Resource
{
    protected static ?string $model = Students::class;
    protected static ?string $modelLabel = 'Students';
    protected static ?string $slug = 'students'; 
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected function handleRecordCreation(array $data): Model
    {
        $record =  static::getModel()::create($data);
        $record->student()->create($data['courses_id']);

        return $record;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
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
                Tables\Columns\TextColumn::make('fname')->label('Firstname')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lname')->label('Lastname')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->searchable()->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->searchable()->sortable()
                    ->dateTime(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('View Subjects')
                    ->color('success')
                    ->icon('heroicon-s-view-list')
                    ->url(fn (Students $record): string => route('filament.resources.students.subjects', $record))

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
            'subjects' => Pages\SubjectsStudents::route('/subjects/{record}'),

        ];
    }    
    
    public static function getEloquentQuery(): Builder 
    {
        $query = parent::getEloquentQuery();

        if (Auth::check() && Auth::user()->hasRole('admin')) {
          
        } else if (Auth::check() && Auth::user()->hasRole('teacher')){
         

        }else
        
        {
            $query->where('email', auth()->user()->email);
        }
        return $query;
    }
    
    public function getTableContent(): ?View
    {
        return view('filament.resources.students-resource.pages.subjects');
    }
}
