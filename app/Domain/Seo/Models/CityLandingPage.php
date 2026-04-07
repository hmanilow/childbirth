<?php

namespace App\Domain\Seo\Models;

use App\Domain\Core\Concerns\HasSeoMeta;
use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Core\Models\DomainModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityLandingPage extends DomainModel
{
    use HasSeoMeta;

    protected $fillable = [
        'city_id',
        'intent',
        'slug',
        'title',
        'excerpt',
        'content',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => PublishStatus::class,
            'published_at' => 'datetime',
        ];
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
