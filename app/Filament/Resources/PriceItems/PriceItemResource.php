<?php

namespace App\Filament\Resources\PriceItems;

use App\Domain\Prices\Models\PriceItem;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PriceItemResource extends Resource
{
    protected static ?string $model = PriceItem::class;
    protected static ?string $navigationLabel = 'Цены';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Название')->required(),
            Textarea::make('description')->label('Описание')->columnSpanFull(),
            TextInput::make('amount')->label('Сумма')->numeric(),
            Select::make('status')->label('Статус')->options(['draft' => 'Черновик', 'published' => 'Опубликовано'])->required(),
            TextInput::make('sort_order')->label('Сортировка')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Название')->searchable(),
            TextColumn::make('amount')->label('Сумма')->money('RUB')->sortable(),
            TextColumn::make('status')->label('Статус')->badge(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManagePriceItems::route('/')];
    }
}
