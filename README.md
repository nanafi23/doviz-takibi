# Currency Management Application

A Laravel 12 university web programming project by Omar Gouda. The application contains authenticated routes for a currency dashboard, currency management and conversion workflows.

## Technology

PHP 8.2+, Laravel 12, Blade, Vite and a relational database. Composer dependencies include Livewire, Jetstream and Sanctum; consult `composer.json` and the source for the actual integrations.

[![Application checks](https://github.com/Omar-Gouda5/doviz-takibi/actions/workflows/checks.yml/badge.svg)](https://github.com/Omar-Gouda5/doviz-takibi/actions/workflows/checks.yml)

## Local setup

Requirements: PHP 8.2 or later with Laravel's required extensions, Composer, Node.js and npm, and a configured database.

```bash
composer install
cp .env.example .env
php artisan key:generate
npm ci
```

The default `.env.example` uses SQLite. Create its file first:

```bash
php -r "touch('database/database.sqlite');"
```

For another database, configure the connection in `.env` and create that database. Then run:

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

This is an academic project, not a production financial service. GitHub Actions verified a fresh Composer install, frontend build, the complete test suite, route caching and view caching using PHP 8.2 and fresh SQLite test databases. Optional-feature scaffold tests retain their configured skip conditions.

Repairs removed overlapping conversion routes and handlers that did not exist, corrected active-currency checks and stored-rate calculations, restricted displayed conversion history to the current user, and repaired profile/authentication view compatibility. See [maintenance notes](docs/portfolio-review.md) and [the regression tests](tests/Feature/CurrencyWorkflowTest.php).

Rates are stored as currency units per USD; conversion is `amount / source_rate * target_rate`, matching the existing update command. They are not a guaranteed live feed. Register an account and add currencies through the dashboard before converting. Authenticated users currently share currency administration; role-based authorization is not implemented.

The desktop browser experience, an existing MySQL database and historical production deployment files were not independently verified. GitHub Pages can show repository documentation but cannot host the Laravel backend. A working PHP server and database are required for a live application.

## Related projects

- [Financial markets frontend prototype](https://github.com/Omar-Gouda5/DOVIZE): a separate static HTML/CSS/JavaScript project.
- `doviz-takipi`: an older closely related Laravel copy; `doviz-takibi` is the selected maintenance version.
