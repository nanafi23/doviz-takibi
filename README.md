# Currency Management Application

A Laravel 12 university web programming project by Omar Gouda. The application contains authenticated routes for a currency dashboard, currency management and conversion workflows.

## Technology

PHP 8.2+, Laravel 12, Blade, Vite and a relational database. Composer dependencies include Livewire, Jetstream and Sanctum; consult `composer.json` and the source for the actual integrations.

## Local setup

Requirements: PHP 8.2 or later with Laravel's required extensions, Composer, Node.js and npm, and a configured database.

```bash
composer install
cp .env.example .env
php artisan key:generate
npm ci
```

Configure your database connection in `.env`, create the database, then run:

```bash
php artisan migrate
npm run build
php artisan serve
```

Use a new local database rather than an existing production database. Never commit `.env` or credentials.

## Source map

- `app/Http/Controllers`: dashboard, currency and conversion logic
- `routes/web.php` and `routes/auth.php`: application and authentication routes
- `resources/views`: server-rendered interface
- `database/migrations`: database schema
- `tests`: existing automated tests

## Validation and project status

This is an academic project undergoing portfolio cleanup, not a production-ready financial service. Setup instructions have been derived from the repository; a fresh installation has not yet been verified during this cleanup.

The conversion routes currently contain overlapping method/path definitions. Those workflows need review and functional testing before deployment. Existing deployment files are historical configurations and do not establish that a live deployment is available.

## Related projects

- [Financial markets frontend prototype](https://github.com/nanafi23/DOVIZE): a separate static HTML/CSS/JavaScript project.
- `doviz-takipi`: an older closely related Laravel copy; `doviz-takibi` is the proposed maintenance version, pending functional validation.
