@php
    use Filament\Support\Enums\ActionSize;
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
    $wireClickAction = "mountFormComponentAction('{$statePath}', '{$action->getName()}', {$wireClickActionArguments})"
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
    :size="ActionSize::Small"
    :icon-size="IconSize::Small"
    :label="$label"
    :$tooltip
>
    {{ $label }}
</x-dynamic-component>
