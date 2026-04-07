# Timeweb Deploy

Use PHP 8.5 and MySQL.

Required:

- Domain document root: `public`
- `.env` based on `.env.example`
- `composer install --no-dev --optimize-autoloader`
- `php artisan migrate --force`
- `php artisan db:seed --force`
- `php artisan storage:link`
- Built assets uploaded to `public/build`

Cron:

```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

Do not rely on:

- Supervisor
- long-running workers for critical flows
- Redis as a required dependency
- Node.js production runtime
- server-side video processing
