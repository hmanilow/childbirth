<?php

namespace App\Domain\Seo\Models;

use App\Domain\Core\Models\DomainModel;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SeoMeta extends DomainModel implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'seo_meta';

    protected $fillable = [
        'seoable_type',
        'seoable_id',
        'meta_title',
        'meta_description',
        'h1',
        'slug',
        'canonical_url',
        'og_title',
        'og_description',
        'robots_meta',
        'noindex',
        'include_in_sitemap',
        'structured_data_json',
    ];

    protected function casts(): array
    {
        return [
            'noindex' => 'boolean',
            'include_in_sitemap' => 'boolean',
            'structured_data_json' => 'array',
        ];
    }

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
