<?php

namespace App\Domain\Seo\Enums;

enum RedirectStatusCode: int
{
    case Permanent = 301;
    case Temporary = 302;
}
