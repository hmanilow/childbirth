<?php

namespace App\Filament\Resources\Leads;

use App\Domain\Leads\Models\Lead;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static ?string $navigationLabel = 'Лиды';
    protected static ?string $modelLabel = 'лид';
    protected static ?string $pluralModelLabel = 'лиды';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Контакт')->schema([
                TextInput::make('name')->label('Имя'),
                TextInput::make('phone')->label('Телефон'),
                TextInput::make('email')->label('Email')->email(),
                TextInput::make('city')->label('Город'),
                Select::make('status')->label('Статус')->options([
                    'new' => 'Новая',
                    'in_progress' => 'В работе',
                    'contacted' => 'Связались',
                    'booked' => 'Записана',
                    'paid' => 'Оплачено',
                    'closed' => 'Закрыта',
                    'canceled' => 'Отменена',
                ])->required(),
            ])->columns(2),
            Section::make('CRM')->schema([
                Textarea::make('message')->label('Сообщение')->columnSpanFull(),
                Textarea::make('notes')->label('Заметки менеджера')->columnSpanFull(),
                TextInput::make('source')->label('Источник')->required(),
                TextInput::make('page_url')->label('Страница')->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Имя')->searchable(),
                TextColumn::make('phone')->label('Телефон')->searchable(),
                TextColumn::make('email')->label('Email')->toggleable(),
                TextColumn::make('status')->label('Статус')->badge(),
                TextColumn::make('source')->label('Источник')->toggleable(),
                TextColumn::make('created_at')->label('Создан')->dateTime('d.m.Y H:i')->sortable(),
            ])
            ->filters([SelectFilter::make('status')->label('Статус')])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageLeads::route('/')];
    }
}
