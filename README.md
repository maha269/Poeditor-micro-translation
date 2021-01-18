# Laravel Poeditor Synchronization

[![Issues](https://img.shields.io/github/issues/maha269/Poeditor-micro-translation)](https://packagist.org/packages/poeditor/laravel-poeditor-sync)
[![Total Downloads](https://packagist.org/packages/poeditor/laravel-poeditor-sync/stats)](https://packagist.org/packages/poeditor/laravel-poeditor-sync)

Upload and download POEditor translations.
Both PHP and JSON translation files are supported.
Vendor PHP / JSON translations can also be uploaded / downloaded.

## Installation

You can install the package via composer:

```bash
composer require poeditor/laravel-poeditor-sync --dev
```

You can add these two classes to providers key in config/app.php:

    NextApps\PoeditorSync\PoeditorSyncServiceProvider::class,
    NextApps\PoeditorSync\PoeditorRouteServiceProvider::class
    
You can publish the configuration file:

```bash
php artisan vendor:publish --provider="NextApps\PoeditorSync\PoeditorSyncServiceProvider"
php artisan vendor:publish --provider="NextApps\PoeditorSync\PoeditorRouteServiceProvider"
```

Set the POEditor API key and Project ID in your env-file:
```
POEDITOR_API_KEY=<your api key>
POEDITOR_PROJECT_ID=<your project id>
```

In the 'poeditor-sync' configuration file, you should specify the supported locales.
You can also provide an associate array, if you want to map POEditor locales to internal locales.

```php
// in config/poeditor-sync.php

// Provide array with all supported locales ...
'locales' => ['en', 'nl', 'fr'],

// ... Or provide associative array with POEditor locales mapped to internal locales
'locales' => ['en-gb' => 'en', 'nl-be' => 'nl'],
```

## Usage

### Download translations

All translations in all supported locales will be downloaded.

``` bash
php artisan poeditor:download
```

### Upload Translations

Upload translations of the default app locale:

``` bash
php artisan poeditor:upload
```

Upload translations of specified locale:

```bash
php artisan poeditor:upload nl
````

Upload translations and overwrite existing POEditor translations:

```bash
php artisan poeditor:upload --force
```

### Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
