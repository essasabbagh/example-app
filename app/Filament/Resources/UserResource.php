<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Users';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->required()->email(),
                TextInput::make('password')->password()
                    ->required()
                    ->minLength(8)
                    ->maxLength(255),
                // Add more fields as needed...
                Forms\Components\Select::make('role_id')
                    ->relationship('roles', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('roles.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    // enable global search on your model, 
    // you must set a title attribute for your resource
    protected static ?string $recordTitleAttribute = 'name';

    // return a plain text string or Htmlable
    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name;
    }

    // search across multiple columns of your resource
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    // display "details" below their title
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            // 'name' => $record->name,
            'email' => $record->email,
        ];
    }

    // // category and author of the record will be displayed in the search result
    // public static function getGlobalSearchEloquentQuery(): Builder
    // {
    //     return parent::getGlobalSearchEloquentQuery()->with(['name', 'email']);
    // }
}
