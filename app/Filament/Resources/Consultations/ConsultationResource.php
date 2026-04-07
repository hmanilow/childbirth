<?php

namespace App\Filament\Resources\Consultations;

use App\Domain\Consultations\Models\Consultation;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;
    protected static ?string $navigationLabel = 'Консультации';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('lead_id')->label('Лид')->relationship('lead', 'name'),
            Select::make('user_id')->label('Ученик')->relationship('student', 'name'),
            TextInput::make('topic')->label('Тема'),
            DateTimePicker::make('scheduled_at')->label('Дата и время'),
            Select::make('status')->label('Статус')->options(['new' => 'Новая', 'booked' => 'Записана', 'done' => 'Проведена', 'canceled' => 'Отменена'])->required(),
            Textarea::make('notes')->label('Заметки')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('topic')->label('Тема')->searchable(),
            TextColumn::make('status')->label('Статус')->badge(),
            TextColumn::make('scheduled_at')->label('Дата')->dateTime('d.m.Y H:i')->sortable(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageConsultations::route('/')];
    }
}
