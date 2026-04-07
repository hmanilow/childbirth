<?php

namespace App\Domain\PageBlocks\Models;

use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Core\Models\DomainModel;
use App\Domain\PageBlocks\Enums\BlockType;
use App\Domain\Pages\Models\Page;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PageBlock extends DomainModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'page_id',
        'type',
        'title',
        'subtitle',
        'body',
        'buttons',
        'config',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'type' => BlockType::class,
            'buttons' => 'array',
            'config' => 'array',
            'status' => PublishStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
