# SEO

SEO data is stored in backend tables rather than hardcoded in Blade templates.

Core tables:

- `seo_meta`: polymorphic metadata for pages, courses, services, news, and city pages
- `seo_redirects`: 301/302 redirects applied by middleware
- `seo_templates`: optional title/description templates
- `cities`: supported city dictionary
- `city_landing_pages`: unique city + intent pages

City landing strategy:

- Start with Балашиха and Москва.
- Keep one unique intent per city.
- Do not clone pages without unique local value.
- Add redirects when changing public slugs.

Structured data:

- Organization
- LocalBusiness
- Course
- BreadcrumbList

These should be generated from settings and entity data, with optional JSON override in `seo_meta.structured_data_json`.
