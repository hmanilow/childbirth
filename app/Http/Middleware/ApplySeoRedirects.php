<?php

namespace App\Http\Middleware;

use App\Domain\Seo\Models\SeoRedirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplySeoRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        $sourcePath = '/'.trim($request->path(), '/');

        $redirect = SeoRedirect::query()
            ->where('is_active', true)
            ->where('source_path', $sourcePath === '/' ? '/' : $sourcePath)
            ->first();

        if (! $redirect) {
            return $next($request);
        }

        $redirect->increment('hits', 1, ['last_hit_at' => now()]);

        return redirect($redirect->target_url, $redirect->status_code->value);
    }
}
