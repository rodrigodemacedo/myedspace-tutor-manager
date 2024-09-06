<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    const GRADE_LEVELS_QTD = 12;
    private static array $gradeLevels = [];
                                                                                                                                                      
    # create a function to, given an int param, return an array with grade levels as: ['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4']
    private static function generateGradeLevels(){
        if(!empty(self::$gradeLevels))
            return null;
        
        for($i = 1; $i <= self::GRADE_LEVELS_QTD; $i++)
            self::$gradeLevels[] = "Grade ".str_pad($i, 2, '0', STR_PAD_LEFT);
    }

    public static function form(Form $form): Form
    {
        self::generateGradeLevels();
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true), // Ensures email is unique, but ignores current record when editing

                Forms\Components\Select::make('grade_level')
                    ->label('Grade Level')
                    ->required()
                    ->placeholder('Select a grade level')
                    ->options(self::$gradeLevels),
            ]);
    }

    public static function table(Table $table): Table
    {
        self::generateGradeLevels();
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('grade_level')
                    ->label('Grade Level')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => self::$gradeLevels[$state])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('name')
            ->recordUrl(null);
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
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
