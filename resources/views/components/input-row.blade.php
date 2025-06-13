@php
    use Filament\Support\Enums\ActionSize;
    use Filament\Support\Enums\IconSize;

    $blockClassName = get_architect_block($blocks, $block['type']);
    $blockName = $blockClassName::make()->getName();
    $shown = (! $hasShownButton) || ($block['shown'] ?? true);
@endphp

<div
    :key="$uuid"
    class="w-full flex gap-2 items-center"
    x-sortable-item="{{ $uuid }}"
    style="grid-column: span {{ $block['width'] ?? 12 }};"
>
    <div @class([
        'relative grow bg-gray-50 dark:bg-gray-800 p-4 rounded-lg
            border dark:border-gray-700 justify-between flex gap-2
            group',
        'bg-gray-50/50 dark:bg-gray-800/50 border-gray-200/50
            dark:border-gray-700/50' => ! $shown
    ])>
        <div @class([
            'flex flex-col text-sm',
            'text-gray-950/50 dark:text-white/40' => ! $shown
        ])>
            <div class="flex gap-1">
                <strong>
                    {{ $block['data']['working_title'] ?? $blockName }}
                </strong>

                @if (! $shown)
                    <span>
                        (hidden)
                    </span>
                @endif

                @foreach ($locales as $locale)
                    <x-filament-architect::locale-indicator
                        :online="$block['data'][$locale]['online'] ?? false"
                        :locale="$locale"
                    />
                @endforeach
            </div>

            <span class="text-xs">
                {{ $blockName }}
            </span>
        </div>

        <div class="
            absolute top-2 right-2 flex gap-1
            opacity-0 group-hover:opacity-100
        ">
            @if (count($row) > 1)
                <x-filament::icon-button
                    color="gray"
                    icon="heroicon-o-arrows-right-left"
                    class="border-2 bg-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-100 dark:hover:text-white cursor-move m-0"
                    :size="ActionSize::Small"
                    :icon-size="IconSize::Small"
                    x-sortable-handle
                />
            @endif

            @if ($hasDuplicateAction)
                <x-filament-architect::icon-button
                    class="dark:bg-gray-800/100 dark:hover:bg-gray-700/100 dark:text-gray-100 dark:hover:text-white"
                    :action="$getAction('duplicateBlock')"
                    :state-path="$statePath"
                    :arguments="[
                        'uuid' => $uuid,
                        'row' => $rowKey,
                    ]"
                    tooltip="Duplicate"
                    />
            @endif

            @if ($hasShownButton)
                <x-filament-architect::icon-button
                    class="dark:bg-gray-800/100 dark:hover:bg-gray-700/100 dark:text-gray-100 dark:hover:text-white"
                    :action="$getAction($shown ? 'enableBlock': 'disableBlock')"
                    :state-path="$statePath"
                    :arguments="[
                        'uuid' => $uuid,
                        'row' => $rowKey,
                    ]"
                    tooltip="{{ $shown ? 'Hide' : 'Show' }}"
                />
            @endif

            <x-filament-architect::icon-button
                class="dark:bg-gray-800/100 dark:hover:bg-gray-700/100 dark:text-gray-100 dark:hover:text-white"
                :action="$getAction('editBlock')"
                :state-path="$statePath"
                :arguments="[
                    'uuid' => $uuid,
                    'row' => $rowKey,
                    'block' => $block,
                    'blockClassName' => $blockClassName,
                    'locales' => $locales,
                ]"
                tooltip="Edit"
            />

            <x-filament-architect::icon-button
                color="danger"
                class="dark:bg-gray-800/100 dark:hover:bg-gray-700/100 dark:text-custom-500 dark:hover:text-custom-400"
                :action="$getAction('deleteBlock')"
                :state-path="$statePath"
                :arguments="[
                    'uuid' => $uuid,
                    'row' => $rowKey,
                ]"
                tooltip="Delete"
            />
        </div>
    </div>

    <div class="flex flex-col gap-2">
        @if ($canAddFields)
            <x-filament-architect::icon-button
                :action="$getAction('addBlockBetween')"
                :state-path="$statePath"
                :arguments="['row' => $rowKey, 'insertAfter' => $uuid]"
            />
        @endif
    </div>
</div>
