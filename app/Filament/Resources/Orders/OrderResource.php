<?php

namespace App\Filament\Resources\Orders;

use App\Domain\Orders\Models\Order;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationLabel = 'Заказы';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('number')->label('Номер')->disabled(),
            Select::make('status')->label('Статус')->options(['pending' => 'Новый', 'awaiting_payment' => 'Ожидает оплаты', 'paid' => 'Оплачен', 'canceled' => 'Отменён', 'refunded' => 'Возврат'])->required(),
            TextInput::make('customer_name')->label('Клиент')->required(),
            TextInput::make('customer_phone')->label('Телефон')->required(),
            TextInput::make('customer_email')->label('Email')->email(),
            TextInput::make('amount')->label('Сумма')->numeric()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('number')->label('Номер')->searchable(),
            TextColumn::make('status')->label('Статус')->badge(),
            TextColumn::make('amount')->label('Сумма')->money('RUB')->sortable(),
            TextColumn::make('customer_phone')->label('Телефон')->searchable(),
            TextColumn::make('created_at')->label('Создан')->dateTime('d.m.Y H:i')->sortable(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageOrders::route('/')];
    }
}
