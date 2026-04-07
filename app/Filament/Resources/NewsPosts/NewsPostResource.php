<?php

namespace App\Filament\Resources\NewsPosts;

use App\Domain\News\Models\NewsPost;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NewsPostResource extends Resource
{
    protected static ?string $model = NewsPost::class;
    protected static ?string $navigationLabel = 'Новости';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Заголовок')->required(),
            TextInput::make('slug')->label('Slug')->required(),
            Textarea::make('excerpt')->label('Анонс')->columnSpanFull(),
            Textarea::make('content')->label('Текст')->columnSpanFull(),
            Select::make('status')->label('Статус')->options(['draft' => 'Черновик', 'published' => 'Опубликовано', 'scheduled' => 'Запланировано'])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Заголовок')->searchable()->sortable(),
            TextColumn::make('status')->label('Статус')->badge(),
            TextColumn::make('published_at')->label('Публикация')->dateTime('d.m.Y H:i')->sortable(),
        ])->actions([EditAction::make()])->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageNewsPosts::route('/')];
    }
}
