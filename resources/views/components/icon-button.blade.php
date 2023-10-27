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
    :size="ActionSize::Small"
    :icon-size="IconSize::Small"
    :label="$label"
>
    {{ $label }}
</x-dynamic-component>
