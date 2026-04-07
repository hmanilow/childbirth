<?php

namespace App\Filament\Resources\SeoRedirects;

use App\Domain\Seo\Models\SeoRedirect;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeoRedirectResource extends Resource
{
    protected static ?string $model = SeoRedirect::class;
    protected static ?string $navigationLabel = 'Redirects';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('source_path')->label('Откуда')->required(),
            TextInput::make('target_url')->label('Куда')->required(),
            Select::make('status_code')->label('Код')->options([301 => '301', 302 => '302'])->required(),
            Select::make('is_active')->label('Активен')->options([1 => 'Да', 0 => 'Нет'])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('source_path')->label('Откуда')->searchable(),
            TextColumn::make('target_url')->label('Куда')->searchable(),
            TextColumn::make('status_code')->label('Код'),
            IconColumn::make('is_active')->label('Активен')->boolean(),
            TextColumn::make('hits')->label('Переходы')->sortable(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageSeoRedirects::route('/')];
    }
}
