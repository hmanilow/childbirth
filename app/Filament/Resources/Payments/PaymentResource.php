<?php

namespace App\Filament\Resources\Payments;

use App\Domain\Payments\Models\Payment;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationLabel = 'Платежи';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('provider')->label('Провайдер'),
            TextColumn::make('provider_payment_id')->label('Provider ID')->searchable()->toggleable(),
            TextColumn::make('internal_status')->label('Статус')->badge(),
            TextColumn::make('amount')->label('Сумма')->money('RUB')->sortable(),
            TextColumn::make('created_at')->label('Создан')->dateTime('d.m.Y H:i')->sortable(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManagePayments::route('/')];
    }
}
