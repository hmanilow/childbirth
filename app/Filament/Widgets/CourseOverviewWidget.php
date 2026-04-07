<?php

namespace App\Filament\Widgets;

use App\Domain\Courses\Models\Course;
use App\Domain\Lessons\Models\Lesson;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CourseOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Активные курсы', Course::query()->where('is_active', true)->count()),
            Stat::make('Опубликованные уроки', Lesson::query()->where('is_published', true)->count()),
            Stat::make('Рекомендуемые курсы', Course::query()->where('is_featured', true)->count()),
        ];
    }
}
