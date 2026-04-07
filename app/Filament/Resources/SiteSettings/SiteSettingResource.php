<?php

namespace App\Filament\Resources\SiteSettings;

use App\Domain\Settings\Models\SiteSetting;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;
    protected static ?string $navigationLabel = 'Настройки сайта';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('key')->label('Ключ')->required(),
            TextInput::make('group')->label('Группа')->required(),
            Select::make('type')->label('Тип')->options(['array' => 'JSON/массив', 'string' => 'Строка', 'boolean' => 'Да/нет'])->required(),
            Select::make('is_public')->label('Публично')->options([1 => 'Да', 0 => 'Нет'])->required(),
            KeyValue::make('value')->label('Значения')->helperText('Храните телефоны, соцсети, SEO defaults и коды аналитики структурированно.')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('key')->label('Ключ')->searchable(),
            TextColumn::make('group')->label('Группа')->sortable(),
            TextColumn::make('type')->label('Тип'),
            IconColumn::make('is_public')->label('Публично')->boolean(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageSiteSettings::route('/')];
    }
}
