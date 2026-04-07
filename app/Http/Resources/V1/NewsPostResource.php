<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsPostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->when($request->routeIs('api.v1.news.show'), $this->content),
            'published_at' => $this->published_at?->toISOString(),
            'seo' => $this->whenLoaded('seoMeta', fn () => new SeoMetaResource($this->seoMeta)),
        ];
    }
}
