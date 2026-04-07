<?php

namespace App\Filament\Resources\CityLandingPages;

use App\Domain\Seo\Models\CityLandingPage;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CityLandingPageResource extends Resource
{
    protected static ?string $model = CityLandingPage::class;
    protected static ?string $navigationLabel = 'City landing pages';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('city_id')->label('Город')->relationship('city', 'name')->required(),
            TextInput::make('intent')->label('Intent')->required()->helperText('Например: doula, birth_preparation. Не создавайте дубли intent без уникальной ценности.'),
            TextInput::make('slug')->label('Slug')->required(),
            TextInput::make('title')->label('Заголовок')->required(),
            Textarea::make('excerpt')->label('Анонс')->columnSpanFull(),
            Textarea::make('content')->label('Уникальный контент')->columnSpanFull(),
            Select::make('status')->label('Статус')->options(['draft' => 'Черновик', 'published' => 'Опубликовано', 'scheduled' => 'Запланировано'])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Страница')->searchable(),
            TextColumn::make('city.name')->label('Город')->sortable(),
            TextColumn::make('intent')->label('Intent')->searchable(),
            TextColumn::make('status')->label('Статус')->badge(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageCityLandingPages::route('/')];
    }
}
