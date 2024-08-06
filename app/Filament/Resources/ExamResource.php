<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->relationship('course', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->required(),

                // Forms\Components\TextInput::make('duration')
                // ->numeric(),
                // Forms\Components\DateTimeRangePicker::make('start_date_time')
                // ->required(),
                // Forms\Components\DateTimeRangePicker::make('end_date_time')
                // ->required(),
                // Forms\Components\Select::make('status')
                // ->options([
                //     'active' => 'Active',
                //     'inactive' => 'Inactive',
                // ])
                // ->required(),
                // Forms\Components\Select::make('passing_percentage')
                // ->options([
                //     '80' => '80',
                //     '90' => '90',
                //     '100' => '100',
                // ])
                // ->required(),
                // Forms\Components\Select::make('language')
                // ->options([
                //     'English' => 'English',
                //     'Spanish' => 'Spanish',
                //     'French' => 'French',
                // ])
                // ->required(),
                // Forms\Components\Select::make('type')
                // ->options([
                //     'online' => 'Online',
                //     'onsite' => 'Onsite',
                // ])
                // ->required(),
                // Forms\Components\Select::make('difficulty')
                // ->options([
                //     'easy' => 'Easy',
                //     'medium' => 'Medium',
                //     'hard' => 'Hard',
                // ])
                // ->required(),
                // Forms\Components\Select::make('structure')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
