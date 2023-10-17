@props([
    'action',
    'statePath',
    'arguments' => [],
    'shown' => false,
])

<div class="z-10 mx-auto w-4/5 h-0">
    <div @class([
        'flex justify-center z-10 w-full h-8 -mt-4',
        'opacity-0 hover:opacity-100 transition-all' => ! $shown,
    ])>
        <x-filament-architect::icon-button
            :action="$action"
            :state-path="$statePath"
            :arguments="$arguments"
            label="Insert block"
        />
    </div>
</div>
