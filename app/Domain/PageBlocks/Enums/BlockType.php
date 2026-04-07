<?php

namespace App\Domain\PageBlocks\Enums;

enum BlockType: string
{
    case Hero = 'hero';
    case RichText = 'rich_text';
    case Features = 'features';
    case Cta = 'cta';
    case ServicesGrid = 'services_grid';
    case CoursesGrid = 'courses_grid';
    case Faq = 'faq';
    case PartnersGrid = 'partners_grid';
    case Testimonials = 'testimonials';
    case Pricing = 'pricing';
    case Contacts = 'contacts';
    case Seo = 'seo';
    case CustomContent = 'custom_content';
}
