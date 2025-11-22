@props([
    'action',
    'statePath',
    'arguments' => [],
    'shown' => false,
    'label' => __('filament-architect::admin.insert block'),
    'aligned' => 'center',
    'class' => null,
])

<div @class([
    'z-10 mx-auto w-4/5' => ($aligned === 'center'),
    $class,
])>
    <div @class([
        'flex flex-wrap',
        'gap-4' => ($aligned === 'left'),
        'justify-center z-10 w-full -mt-4 gap-4' => ($aligned === 'center'),
        'opacity-0 hover:opacity-100 transition-all' => ! $shown,
    ])>
        <x-filament-architect::icon-button
            class="dark:hover:!bg-gray-700/100 dark:!bg-gray-800"
            :action="$action"
            :state-path="$statePath"
            :arguments="$arguments"
            :label="$label"
        />

        {{ $slot }}
    </div>
</div>
