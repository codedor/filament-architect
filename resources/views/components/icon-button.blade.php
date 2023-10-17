@props([
    'action',
    'statePath',
    'arguments' => [],
    'color' => 'gray',
    'label' => null,
])

@php
    $wireClickActionArguments = \Illuminate\Support\Js::from($arguments);
    $wireClickAction = "mountFormComponentAction('{$statePath}', '{$action->getName()}', {$wireClickActionArguments})"
@endphp

<x-dynamic-component
    :component="$label ? 'filament::button' : 'filament::icon-button'"
    @class(['border-2 bg-white' => ! $label])
    :color="$color"
    :wire:click="$wireClickAction"
    :icon="$action->getIcon()"
    size="sm"
    icon-size="sm"
    :label="$label"
>
    {{ $label }}
</x-dynamic-component>
