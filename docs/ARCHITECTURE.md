# Architecture

The project is a single Laravel monolith with explicit domain modules under `app/Domain`.

Entry points:

- Public web: Blade + Livewire controllers in `app/Http/Controllers/Web`
- Admin/CRM: Filament resources in `app/Filament`
- API: versioned `/api/v1` controllers and resources in `app/Http/Controllers/Api/V1`
- Webhooks: isolated controllers in `app/Http/Controllers/Webhooks`

Rules:

- Keep controllers thin.
- Put business logic in domain actions/services.
- Use Form Requests for boundary validation.
- Use Policies/Gates for sensitive access.
- Do not put critical domain logic inside Filament form/table callbacks.
- Keep payments and access grants idempotent.
- Keep the production runtime PHP-only; Node is only for local/CI asset builds.
