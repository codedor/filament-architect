# Architect field for Filament

## Introduction

The Architect field is an optimised and improved version of the default Builder field. The form is not inline, but in a modal, this way the main form is not bloated anymore if there is a large amount of selected blocks.

These blocks are also reusable, so the schema for these blocks don't have to be rewritten every time.

![architect screenshot](./architect.png)

Next to that it's also possible to add templates and re-use them in your records.

## Installation

First, install this package via the Composer package manager:

```bash
composer require codedor/filament-architect
```

Register the plugin in your Panel provider:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            \Codedor\FilamentArchitect\Filament\ArchitectPlugin::make(),
        ]);
    }
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
    'attachmentFormats' => [
        \Codedor\MediaLibrary\Formats\Thumbnail::class,
    ],
];
```

## Adding new blocks

To add new blocks, you can extend `\Codedor\FilamentArchitect\Filament\Architect\BaseBlock`.
You have to add a `schema` and a `render` function. 

In the schema array you can add [Filament fields](https://filamentphp.com/docs/3.x/forms/fields/getting-started).

```php
public function schema(): array
{
    return [];
}
```

In the render function you can return the view that will be rendered in the front-end.

```php
public function render(array $data): ?View
{
    return view('architect.button-block', [
        'buttons' => collect($data['buttons'])->pluck('button'),
        'alignment' => $data['alignment'] ?? 'left',
    ]);
}
```

Or you can also create both with our artisan command:

```bash
php artisan make:architect-block ButtonBlock
```

## Rendering Architect

To render Architect you can add an attribute in your model:

```php
public function getBodyAttribute($value): \Codedor\FilamentArchitect\Engines\Architect|string
{
    return \Codedor\FilamentArchitect\Engines\Architect::make($value);
}
```

We return an Architect or string, because Filament needs a string to be able to fill the field with the existing data.

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

### attachmentFormats

Since AttachmentInput fields are not immediately related to a model, we have to define the formats for each AttachmentInput field manually.
This can be done via this config.

If you add your own block, don't forget to add the `allowedFormats` method to the AttachmentInput field with our helper.

```php
AttachmentInput::make('image')
    ->allowedFormats(ArchitectFormats::get())
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

To modify the blocks we provide some custom blocks.

##### excludedBlocks(array $blocksToExclude): ArchitectInput

With this method you can exclude default blocks from the Architect field.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\PageArchitectInput::make('body')
        ->excludedBlocks([
            \Codedor\FilamentArchitect\Filament\Architect\ButtonBlock::make(),
        ]),
];
```

##### addBlocks(array $blocksToAdd): ArchitectInput

With this method you can add blocks to the Architect field.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body')
        ->addBlocks([
            \App\Architect\CustomBlock::class,
        ]),
];
```

##### blocks(array $blocks): ArchitectInput

With this method you can overwrite all default blocks on the Architect field.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body')
        ->blocks([
            \App\Architect\CustomBlock::class,
        ]),
];
```

##### maxFieldsPerRow(null|int|Closure $maxFieldsPerRow): ArchitectInput

With this you can set the maximum amount of fields per row.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body')
        ->maxFieldsPerRow(1),
];
```

##### hasTemplates(Closure|bool $hasTemplates): ArchitectInput

With this you can enable or disable the "Start from template" action. Defaults to true.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body')
        ->hasTemplates(false),
];
```

##### hasPreview(Closure|bool $hasPreview): ArchitectInput

With this you can enable or disable the "Preview" action. Defaults to true.

```php
return [
    \Codedor\FilamentArchitect\Filament\Fields\Architect::make('body')
        ->hasPreview(false),
];
```
