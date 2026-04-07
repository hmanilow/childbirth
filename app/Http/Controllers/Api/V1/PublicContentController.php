<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Courses\Models\Course;
use App\Domain\News\Models\NewsPost;
use App\Domain\Pages\Models\Page;
use App\Domain\Partners\Models\Partner;
use App\Domain\Services\Models\Service;
use App\Http\Resources\V1\CourseResource;
use App\Http\Resources\V1\NewsPostResource;
use App\Http\Resources\V1\PageResource;
use App\Http\Resources\V1\PartnerResource;
use App\Http\Resources\V1\ServiceResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class PublicContentController extends Controller
{
    public function page(string $slug): PageResource
    {
        return new PageResource(Page::query()->with(['blocks', 'seoMeta'])->where('slug', $slug)->firstOrFail());
    }

    public function news(): AnonymousResourceCollection
    {
        return NewsPostResource::collection(NewsPost::query()->published()->latest('published_at')->paginate(12));
    }

    public function newsShow(string $slug): NewsPostResource
    {
        return new NewsPostResource(NewsPost::query()->with('seoMeta')->published()->where('slug', $slug)->firstOrFail());
    }

    public function partners(): AnonymousResourceCollection
    {
        return PartnerResource::collection(Partner::query()->published()->orderBy('sort_order')->paginate(50));
    }

    public function services(): AnonymousResourceCollection
    {
        return ServiceResource::collection(Service::query()->with('seoMeta')->published()->orderBy('sort_order')->paginate(50));
    }

    public function courses(): AnonymousResourceCollection
    {
        return CourseResource::collection(Course::query()->with('seoMeta')->published()->orderBy('sort_order')->paginate(12));
    }

    public function courseShow(string $slug): CourseResource
    {
        return new CourseResource(
            Course::query()
                ->with(['modules.lessons' => fn ($query) => $query->published(), 'seoMeta'])
                ->published()
                ->where('slug', $slug)
                ->firstOrFail()
        );
    }
}
