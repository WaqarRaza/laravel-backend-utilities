# Laravel Utilities Package

## Step 1

```bash
composer require waqarraza/laravel-backend-utilities
```

## Step 2

For Laravel version <= 5.4

You can skip this step for Laravel version >= 5.5

Add these following lines in config/app.php

```php
'providers' => [
    ...
    Waqar\Utility\Provider\UtilityServiceProvider::class,
    ...
]

'aliases' => [
    ...
    'LaravelUtil' => Waqar\Utility\Facade\LaravelUtil::class,
    ...
]
```

# Available Methods

- LaravelUtil::dashboardStatsQuery
- LaravelUtil::storeImage
- LaravelUtil::updateImage

### Note

Please provide your feedback to upgrade this package and add more methods that are used commonly but almost always has to look up the code :blush: