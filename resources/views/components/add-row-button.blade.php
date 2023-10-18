@props([
    'action',
    'statePath',
    'arguments' => [],
    'shown' => false,
    'label' => 'Insert block',
    'aligned' => 'center',
])

<div @class([
    'z-10 mx-auto w-4/5 h-0' => ($aligned === 'center'),
])>
    <div @class([
        'flex gap-4' => ($aligned === 'left'),
        'flex justify-center z-10 w-full h-8 -mt-4 gap-4' => ($aligned === 'center'),
        'opacity-0 hover:opacity-100 transition-all' => ! $shown,
    ])>
        <x-filament-architect::icon-button
            :action="$action"
            :state-path="$statePath"
            :arguments="$arguments"
            :label="$label"
        />

        {{ $slot }}
    </div>
</div>
