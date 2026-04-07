<?php

namespace App\Domain\Leads\Enums;

enum LeadStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Contacted = 'contacted';
    case Booked = 'booked';
    case Paid = 'paid';
    case Closed = 'closed';
    case Canceled = 'canceled';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Новая',
            self::InProgress => 'В работе',
            self::Contacted => 'Связались',
            self::Booked => 'Записана',
            self::Paid => 'Оплачено',
            self::Closed => 'Закрыта',
            self::Canceled => 'Отменена',
        };
    }
}
