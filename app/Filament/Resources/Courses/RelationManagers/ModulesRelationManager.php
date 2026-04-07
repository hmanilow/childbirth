<?php

namespace App\Filament\Resources\Courses\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules';
    protected static ?string $title = 'Модули';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Название')->required(),
            Textarea::make('description')->label('Описание')->columnSpanFull(),
            TextInput::make('sort_order')->label('Сортировка')->numeric()->default(0),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Модуль')->searchable(),
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([EditAction::make(), DeleteAction::make()]);
    }
}
