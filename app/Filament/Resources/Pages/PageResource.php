<?php

namespace App\Filament\Resources\Pages;

use App\Domain\Pages\Models\Page;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationLabel = 'Страницы';
    protected static ?string $modelLabel = 'страница';
    protected static ?string $pluralModelLabel = 'страницы';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Контент')->schema([
                TextInput::make('title')->label('Заголовок')->required()->maxLength(255),
                TextInput::make('slug')->label('Slug')->required()->maxLength(255),
                Select::make('type')->label('Тип')->options([
                    'static' => 'Обычная',
                    'service' => 'Услуга',
                    'legal' => 'Юридическая',
                    'city_landing' => 'Городская',
                ])->required(),
                Textarea::make('excerpt')->label('Краткое описание')->columnSpanFull(),
                Textarea::make('content')->label('Контент')->columnSpanFull(),
            ])->columns(2),
            Section::make('Публикация')->schema([
                Select::make('status')->label('Статус')->options([
                    'draft' => 'Черновик',
                    'published' => 'Опубликовано',
                    'scheduled' => 'Запланировано',
                    'archived' => 'Архив',
                ])->required(),
                TextInput::make('sort_order')->label('Сортировка')->numeric()->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Страница')->searchable()->sortable(),
                TextColumn::make('slug')->label('Slug')->searchable()->toggleable(),
                TextColumn::make('status')->label('Статус')->badge()->colors([
                    'gray' => 'draft',
                    'success' => 'published',
                    'warning' => 'scheduled',
                    'danger' => 'archived',
                ]),
                TextColumn::make('updated_at')->label('Обновлено')->dateTime('d.m.Y H:i')->sortable(),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BlocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePages::route('/'),
        ];
    }
}
