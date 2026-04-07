<?php

namespace App\Filament\Resources\Users;

use App\Domain\Users\Models\User;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Пользователи';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Имя')->required(),
            TextInput::make('email')->label('Email')->email(),
            TextInput::make('phone')->label('Телефон'),
            TextInput::make('city')->label('Город'),
            Select::make('is_active')->label('Активен')->options([1 => 'Да', 0 => 'Нет'])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Имя')->searchable(),
            TextColumn::make('email')->label('Email')->searchable(),
            TextColumn::make('phone')->label('Телефон')->searchable()->toggleable(),
            IconColumn::make('is_active')->label('Активен')->boolean(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageUsers::route('/')];
    }
}
