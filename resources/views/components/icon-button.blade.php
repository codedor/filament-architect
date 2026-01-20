@php
    use Filament\Support\Enums\Size;
    use Filament\Support\Enums\IconSize;
@endphp

@props([
    'action',
    'statePath',
    'arguments' => [],
    'color' => 'gray',
    'label' => null,
    'class' => null,
    'tooltip' => null,
])

@php
    $wireClickActionArguments = \Illuminate\Support\Js::from($arguments);
    $wireClickActionMeta = \Illuminate\Support\Js::from(['schemaComponent' => str_replace('data.', 'form.', $statePath)]);
    $wireClickAction = "mountAction('{$action->getName()}', {$wireClickActionArguments}, {$wireClickActionMeta})"
@endphp

<x-dynamic-component
    :component="$label ? 'filament::button' : 'filament::icon-button'"
    @class([
        'border-2 bg-white dark:bg-white/5 dark:hover:bg-white/10 dark:border-gray-700 m-0' => ! $label,
        $class
    ])
    :color="$color"
    :wire:click="$wireClickAction"
    :icon="$action->getIcon()"
    :size="Size::Small"
    :icon-size="IconSize::Small"
    :label="$label"
    :$tooltip
>
    {{ $label }}
</x-dynamic-component>
