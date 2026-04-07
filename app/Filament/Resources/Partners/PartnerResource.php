<?php

namespace App\Filament\Resources\Partners;

use App\Domain\Partners\Models\Partner;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationLabel = 'Партнёры';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Имя')->required(),
            TextInput::make('slug')->label('Slug')->required(),
            TextInput::make('specialization')->label('Специализация'),
            TextInput::make('url')->label('Ссылка')->url(),
            Textarea::make('short_description')->label('Описание')->columnSpanFull(),
            Select::make('status')->label('Статус')->options(['draft' => 'Черновик', 'published' => 'Опубликовано'])->required(),
            TextInput::make('sort_order')->label('Сортировка')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Имя')->searchable(),
            TextColumn::make('specialization')->label('Специализация')->toggleable(),
            TextColumn::make('status')->label('Статус')->badge(),
            TextColumn::make('sort_order')->label('Порядок')->sortable(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManagePartners::route('/')];
    }
}
