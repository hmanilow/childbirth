<?php

namespace App\Domain\Students\Enums;

enum AccessGrantSource: string
{
    case Payment = 'payment';
    case Admin = 'admin';
    case Promo = 'promo';
    case Import = 'import';
}
