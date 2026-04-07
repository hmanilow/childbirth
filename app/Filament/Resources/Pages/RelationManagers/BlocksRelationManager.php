<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BlocksRelationManager extends RelationManager
{
    protected static string $relationship = 'blocks';
    protected static ?string $title = 'Блоки страницы';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('type')->label('Тип')->options([
                'hero' => 'Hero',
                'rich_text' => 'Текст',
                'features' => 'Преимущества',
                'cta' => 'CTA',
                'services_grid' => 'Услуги',
                'courses_grid' => 'Курсы',
                'faq' => 'FAQ',
                'partners_grid' => 'Партнёры',
                'testimonials' => 'Отзывы',
                'pricing' => 'Цены',
                'contacts' => 'Контакты',
                'seo' => 'SEO-блок',
                'custom_content' => 'Rich content',
            ])->required(),
            TextInput::make('title')->label('Заголовок')->maxLength(255),
            TextInput::make('subtitle')->label('Подзаголовок')->maxLength(255),
            Textarea::make('body')->label('Текст')->columnSpanFull(),
            TextInput::make('sort_order')->label('Сортировка')->numeric()->default(0),
            Select::make('status')->label('Статус')->options(['draft' => 'Черновик', 'published' => 'Опубликовано'])->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')->label('Тип')->sortable(),
                TextColumn::make('title')->label('Заголовок')->searchable(),
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([EditAction::make(), DeleteAction::make()]);
    }
}
