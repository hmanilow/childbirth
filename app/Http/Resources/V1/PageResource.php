<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'type' => $this->type,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'blocks' => $this->whenLoaded('blocks', fn () => $this->blocks->map(fn ($block) => [
                'type' => $block->type->value,
                'title' => $block->title,
                'subtitle' => $block->subtitle,
                'body' => $block->body,
                'buttons' => $block->buttons,
                'config' => $block->config,
            ])),
            'seo' => $this->whenLoaded('seoMeta', fn () => new SeoMetaResource($this->seoMeta)),
        ];
    }
}
