<?php

namespace App\Domain\Courses\Enums;

enum CourseAccessType: string
{
    case Paid = 'paid';
    case Free = 'free';
    case Manual = 'manual';
}
