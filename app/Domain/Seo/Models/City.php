<?php

namespace App\Domain\Seo\Models;

use App\Domain\Core\Models\DomainModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends DomainModel
{
    protected $fillable = [
        'name',
        'slug',
        'region',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function landingPages(): HasMany
    {
        return $this->hasMany(CityLandingPage::class);
    }
}
