<?php

namespace App\Filament\Resources\Courses;

use App\Domain\Courses\Models\Course;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?string $navigationLabel = 'Курсы';
    protected static ?string $modelLabel = 'курс';
    protected static ?string $pluralModelLabel = 'курсы';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Описание')->schema([
                TextInput::make('title')->label('Название')->required()->maxLength(255),
                TextInput::make('slug')->label('Slug')->required()->maxLength(255),
                TextInput::make('subtitle')->label('Подзаголовок')->maxLength(255),
                Textarea::make('short_description')->label('Краткое описание')->columnSpanFull(),
                Textarea::make('full_description')->label('Полное описание')->columnSpanFull(),
            ])->columns(2),
            Section::make('Продажи и публикация')->schema([
                TextInput::make('price')->label('Цена')->numeric()->required(),
                TextInput::make('old_price')->label('Старая цена')->numeric(),
                Select::make('access_type')->label('Тип доступа')->options(['paid' => 'Платный', 'free' => 'Бесплатный', 'manual' => 'Ручной'])->required(),
                Select::make('status')->label('Статус')->options(['draft' => 'Черновик', 'published' => 'Опубликовано', 'scheduled' => 'Запланировано', 'archived' => 'Архив'])->required(),
                Select::make('is_active')->label('Активен')->options([1 => 'Да', 0 => 'Нет'])->required(),
                Select::make('is_featured')->label('Рекомендуемый')->options([1 => 'Да', 0 => 'Нет'])->required(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Курс')->searchable()->sortable(),
                TextColumn::make('price')->label('Цена')->money('RUB')->sortable(),
                TextColumn::make('status')->label('Статус')->badge(),
                IconColumn::make('is_active')->label('Активен')->boolean(),
                IconColumn::make('is_featured')->label('Рек.')->boolean(),
                TextColumn::make('updated_at')->label('Обновлено')->dateTime('d.m.Y H:i')->sortable(),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [RelationManagers\ModulesRelationManager::class];
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageCourses::route('/')];
    }
}
