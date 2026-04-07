<?php

namespace App\Domain\Core\Enums;

enum PublishStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Scheduled = 'scheduled';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Черновик',
            self::Published => 'Опубликовано',
            self::Scheduled => 'Запланировано',
            self::Archived => 'Архив',
        };
    }
}
