# Childbirth School Platform

Laravel 12 monolith for a Russian maternity school, doula services, CRM, CMS, LMS-light courses, YooKassa payments, SEO, and future `/api/v1` clients.

## Stack

- PHP 8.5 target
- Laravel 12
- MySQL
- Blade + Livewire + Tailwind for the public site
- Filament for CRM/admin
- Laravel Sanctum for `/api/v1`
- Spatie Laravel Permission for roles and permissions
- Spatie Media Library for images and files
- YooKassa SDK for checkout and payment verification

## Local Setup

This repository contains the Laravel source scaffold. The current machine does not have `php` or `composer` available, so dependencies were not installed here.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
```

## Timeweb Deploy Checklist

1. Upload the repository to the hosting account.
2. Run `composer install --no-dev --optimize-autoloader`.
3. Set the domain document root to `public`.
4. Create `.env` from `.env.example` and fill production values.
5. Run `php artisan key:generate` only if `APP_KEY` is missing.
6. Run `php artisan migrate --force`.
7. Run `php artisan db:seed --class=Database\\Seeders\\RolePermissionSeeder --force`.
8. Run `php artisan db:seed --class=Database\\Seeders\\SiteSettingsSeeder --force`.
9. Run `php artisan storage:link`.
10. Upload already-built frontend assets from `public/build`.
11. Add cron:

```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

Do not rely on Supervisor, Redis workers, Node.js SSR, or long-running daemons for critical MVP flows.
