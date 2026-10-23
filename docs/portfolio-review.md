# Portfolio maintenance review

The application stores rates as currency units per one common base unit (USD), matching `exchange-rates:update`. Conversion is `amount / source_rate * target_rate`; sample figures in tests are fixtures, not current exchange rates.

Repairs cover active-currency filtering, positive-rate validation, conversion history scoped to the signed-in user, HTTP methods, public pricing view, profile routes and component layout rendering. Old conversion routes targeting nonexistent controller methods were removed. A GET request cannot create or delete conversion records.

`tests/Feature/CurrencyWorkflowTest.php` exercises public pages, authenticated conversion, reverse conversion, inactive/zero-rate rejection and user-history separation with a fresh in-memory SQLite database. GitHub Actions installs PHP/Composer and frontend dependencies, runs the test suite, and checks route/view caching.

This is coursework software with shared currency administration for authenticated accounts. Rates are stored values, not a guaranteed real-time feed. There has been no production hosting, payment processing or external financial transaction validation. Existing MySQL data and rollback paths need separate migration review; these checks use fresh SQLite databases.
