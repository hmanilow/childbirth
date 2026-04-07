# QA Done Checklist

Use this before calling a feature complete.

## Done checklist

- [x] Domain entities have explicit models/enums/actions.
- [x] Database migrations include foreign keys and common indexes.
- [x] Web, API, webhook, and admin entry points are separated.
- [x] Payment flow stores events before processing and is idempotent.
- [x] Course access is represented by access grants, not order status alone.
- [x] API routes are versioned under `/api/v1`.
- [x] Shared-hosting constraints avoid supervisor, Node SSR, and required long-running workers.
- [ ] Composer dependencies installed.
- [ ] PHP syntax check completed.
- [ ] Migrations executed.
- [ ] Feature tests executed.

## Risks

- PHP and Composer are not available in the current environment, so Laravel commands were not executed here.
- Filament v5 APIs should be verified after dependency install because this scaffold is written against the current resource/schema style.
- YooKassa credentials and webhook source validation must be finalized against the production shop settings.

## What to verify manually

- `composer install`
- `php artisan migrate --seed`
- `php artisan route:list`
- `php artisan test`
- `npm install && npm run build`
- `/admin` login and resource discovery
- YooKassa test payment and duplicate webhook replay

## Follow-ups

- Add richer Filament relation managers for lesson attachments, payment events, and lead timeline once the first admin UX pass is tested by a real manager.
- Add schema builders for JSON-LD rendering.
- Add cron reconciliation command for delayed YooKassa confirmations.
