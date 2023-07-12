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

This is the contents of the published config file:

```php
return [
    'default-blocks' => [
        \Codedor\FilamentArchitect\Filament\Architect\ButtonBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\CardBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\CtaBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\EmbedBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\MediaBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\MediaTextBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\SliderBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\SpacerBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\TableBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\TextBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\VideoBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\VideoTextBlock::class,
    ],
    'widthOptions' => \Codedor\FilamentArchitect\Enums\WidthOptions::class,
    'buttonClasses' => [
        'btn btn-primary' => 'Primary button',
        'btn btn-link' => 'Text',
    ],
    'trackingActions' => ['hit', 'play', 'pause', 'download', 'view', 'open', 'close'],
];
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

Or you can also create both with our artisan command:

```bash
php artisan make:architect-block NameOfBlock
```

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

## Components

We provide some components that you can use in your blocks.

### ButtonComponent

This will render a button that opens a modal where you can fill in fields to show a button in the block.
This integrates with our [codedor/filament-link-picker](https://github.com/codedor/filament-link-picker) package.

```php
\Codedor\FilamentArchitect\Filament\Components\ButtonComponent::make('button')
```

## Config

### Default blocks

Here you can set the default blocks that will be shown by default in all Architect fields.
This must be an array.

Default value: 

```php
[
    \Codedor\FilamentArchitect\Filament\Architect\ButtonBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\CardBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\CtaBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\EmbedBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\MediaBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\MediaTextBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\SliderBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\SpacerBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\TableBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\TextBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\VideoBlock::class,
    \Codedor\FilamentArchitect\Filament\Architect\VideoTextBlock::class,
]
```

### widthOptions

This is an enum where you can set the width options for some blocks.
If you don't want to use this enum and hide the field, you can set it to null.

Default value:

```php
\Codedor\FilamentArchitect\Enums\WidthOptions::class
```

### buttonClasses

Here you can set the button classes that will be shown in the button component.
This must be an array.

Default value:

```php
[
    'btn btn-primary' => 'Primary button',
    'btn btn-link' => 'Text',
]
```

### trackingActions

Here you can set the tracking actions that will be shown in the button component.
This must be an array.

Default value:

```php
[
    'hit', 
    'play', 
    'pause', 
    'download', 
    'view', 
    'open', 
    'close'
]
```

## Filament

### Architect Field

To use the Architect field in Filament you can add it to your resource:

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body'),
];
```

#### Methods

See the [Builder](https://filamentphp.com/docs/2.x/forms/fields#builder) documentation for all available methods.

To modify the blocks we provide some custom blocks.

##### excludeBlocks(array $blocksToExclude): Architect

With this method you can exclude default blocks from the Architect field.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body')
        ->excludeBlocks([
            \Codedor\FilamentArchitect\Filament\Architect\ButtonBlock::class,
        ]),
];
```

##### addBlocks(array $blocksToAdd): Architect

With this method you can add blocks to the Architect field.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body')
        ->addBlocks([
            \App\Architect\CustomBlock::class,
        ]),
];
```

##### blocks(array $blocks): Architect

With this method you can overwrite all default blocks on the Architect field.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body')
        ->blocks([
            \App\Architect\CustomBlock::make()->toFilament(),
        ]),
];
```

Here you don't pass the class name, but the block itself. You can use the `toFilament` method to convert it to a Filament schema.
