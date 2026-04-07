<?php

namespace App\Domain\Seo\Enums;

enum SeoEntityType: string
{
    case Page = 'page';
    case NewsPost = 'news_post';
    case Service = 'service';
    case Course = 'course';
    case CityLanding = 'city_landing';
}
