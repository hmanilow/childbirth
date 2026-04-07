<?php

namespace App\Filament\Resources\Services;

use App\Domain\Services\Models\Service;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationLabel = 'Услуги';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Название')->required(),
            TextInput::make('slug')->label('Slug')->required(),
            Textarea::make('short_description')->label('Кратко')->columnSpanFull(),
            Textarea::make('full_description')->label('Полное описание')->columnSpanFull(),
            TextInput::make('price_from')->label('Цена от')->numeric(),
            Select::make('status')->label('Статус')->options(['draft' => 'Черновик', 'published' => 'Опубликовано'])->required(),
            TextInput::make('sort_order')->label('Сортировка')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Услуга')->searchable(),
            TextColumn::make('price_from')->label('Цена от')->money('RUB')->sortable(),
            TextColumn::make('status')->label('Статус')->badge(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageServices::route('/')];
    }
}
