<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TutorResource\Pages;
use App\Models\Tutor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class TutorResource extends Resource
{
    protected static ?string $model = Tutor::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    private static array $subjects = ['Math', 'Science', 'History', 'English'];

    public static function form(Form $form): Form
    {
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
                //     ->rules([
                //     Rule::unique(Tutor::class, 'email')->ignore(request()->route('record')),
                // ]),
                    ->unique(ignoreRecord:true), // Unique email validation

                Forms\Components\TextInput::make('hourly_rate')
                    ->label('Hourly Rate')
                    ->required()
                    ->numeric()
                    ->minValue(0), // Hourly rate must be positive

                Forms\Components\Select::make('subjects')
                    ->label('Subjects')
                    ->required()
                    ->placeholder('Add subjects')
                    ->options(self::$subjects) // Example subjects
                    ->multiple(),
                
                Forms\Components\FileUpload::make('avatar')
                    ->label('Avatar')
                    ->image()
                    ->directory('avatars')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                    ->maxSize(2048) // Max 2MB
                    ->nullable(),

                Forms\Components\Textarea::make('bio')
                    ->label('Bio')
                    ->nullable()
                    ->maxLength(1000),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('hourly_rate')
                    ->label('Hourly Rate')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => "$".$state),
                
                Tables\Columns\TextColumn::make('subjects')
                    ->label('Subjects')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn (string $state) : string => self::$subjects[$state])
            ])
            
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTutors::route('/'),
            'create' => Pages\CreateTutor::route('/create'),
            'edit' => Pages\EditTutor::route('/{record}/edit'),
        ];
    }
}
