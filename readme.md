## Installation

Add the ServiceProvider to the providers array in config/app.php

```php
Belt\Menu\BeltMenuServiceProvider::class,
```

```
# publish
php artisan belt-menu:publish
composer dumpautoload

# migration
php artisan migrate

# seed
php artisan db:seed --class=BeltMenuSeeder

# compile assets
npm run
```