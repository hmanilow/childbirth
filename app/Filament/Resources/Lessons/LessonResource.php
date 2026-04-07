<?php

namespace App\Filament\Resources\Lessons;

use App\Domain\Lessons\Models\Lesson;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;
    protected static ?string $navigationLabel = 'Уроки';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('course_id')->label('Курс')->relationship('course', 'title')->required(),
            Select::make('module_id')->label('Модуль')->relationship('module', 'title'),
            TextInput::make('title')->label('Название')->required(),
            TextInput::make('slug')->label('Slug')->required(),
            Textarea::make('short_description')->label('Кратко')->columnSpanFull(),
            Textarea::make('content')->label('Контент')->columnSpanFull(),
            TextInput::make('video_url')->label('Внешняя ссылка на видео')->url(),
            TextInput::make('duration')->label('Длительность, мин')->numeric(),
            Select::make('is_preview')->label('Preview')->options([1 => 'Да', 0 => 'Нет'])->required(),
            Select::make('is_published')->label('Опубликован')->options([1 => 'Да', 0 => 'Нет'])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Урок')->searchable(),
            TextColumn::make('course.title')->label('Курс')->sortable(),
            IconColumn::make('is_preview')->label('Preview')->boolean(),
            IconColumn::make('is_published')->label('Опубл.')->boolean(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageLessons::route('/')];
    }
}
