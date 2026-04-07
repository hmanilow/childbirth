<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'short_description' => $this->short_description,
            'full_description' => $this->when($request->routeIs('api.v1.courses.show'), $this->full_description),
            'price' => $this->price,
            'old_price' => $this->old_price,
            'access_type' => $this->access_type?->value,
            'modules' => $this->whenLoaded('modules', fn () => $this->modules->map(fn ($module) => [
                'id' => $module->id,
                'title' => $module->title,
                'description' => $module->description,
                'lessons' => $module->lessons->map(fn ($lesson) => [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'slug' => $lesson->slug,
                    'is_preview' => $lesson->is_preview,
                    'duration' => $lesson->duration,
                ]),
            ])),
            'seo' => $this->whenLoaded('seoMeta', fn () => new SeoMetaResource($this->seoMeta)),
        ];
    }
}
