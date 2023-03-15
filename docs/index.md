# Architect field for Filament

## Introduction

The Architect field extends the default [Builder](https://filamentphp.com/docs/2.x/forms/fields#builder) field from Filament with possibility to add default blocks via the config file.

These blocks are also reusable, so the schema for these blocks don't have to be rewritten every time.

![architect screenshot](./architect.png)

## Installation

First, install this package via the Composer package manager:

```bash
composer require codedor/filament-architect
```

### Publish the config file

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-architect-config"
```

## Adding new blocks

To add new blocks, you can extend `\Codedor\FilamentArchitect\Filament\Architect\BaseBlock`.
You have to add a `schema` function. In this array you can add [Filament fields](https://filamentphp.com/docs/2.x/admin/resources/getting-started#fields).

```php
public function schema(): array
{
    return [];
}
```

If you want to extend the default functionality you can look in the BaseBlock file to see what's possible.

Next to the PHP file you have to also create a `architect.name-of-block.blade.php` file that will be rendered in front-end.

## Rendering Architect

To render Architect you can add an attribute in your model:

```php
public function getBodyAttribute($value): \Codedor\FilamentArchitect\Architect|string
{
    return new \Codedor\FilamentArchitect\Architect($value);
}
```

We return an Architect or string, because Filament needs a string to be able to fill the Builder field with the block data.

In the blade file you can then add:

```blade
{{ $post->body }}
```
