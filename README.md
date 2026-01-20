# Architect field for Filament

This package extends the default [Builder](https://filamentphp.com/docs/2.x/forms/fields#builder) field from Filament with some default blocks.

![architect screenshot](./docs/architect.png)

## Installation

You can install the package via composer:

```bash
composer require wotz/filament-architect
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-architect-config"
```

This is the contents of the published config file:

```php
return [
    'default-blocks' => [
        // ...
    ]
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-architect-views"
```

## Usage

```php
\Wotz\FilamentArchitect\Filament\Fields\PageArchitectInput::make('body')
    ->required(),
```

## Documentation

For the full documentation, check [here](./docs/index.md).

## Testing

```bash
vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Upgrading

Please see [UPGRADING](UPGRADING.md) for more information on how to upgrade to a new version.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

If you discover any security-related issues, please email info@whoownsthezebra.be instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
