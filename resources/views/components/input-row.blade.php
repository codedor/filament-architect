@php
    use Filament\Support\Enums\ActionSize;
    use Filament\Support\Enums\IconSize;

    $blockClassName = get_architect_block($blocks, $block['type']);
    $blockName = $blockClassName::make()->getName();
@endphp

<div
    :key="$uuid"
    class="w-full flex gap-2 items-center"
    x-sortable-item="{{ $uuid }}"
    style="grid-column: span {{ $block['width'] ?? 12 }};"
>
    <div class="
        relative grow bg-gray-50 p-4 rounded-lg
        border justify-between flex gap-2
        group
    ">
        <div class="flex flex-col text-sm">
            <div class="flex gap-1">
                <strong>
                    {{ $block['data']['working_title'] ?? $blockName }}
                </strong>

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
                    class="border-2 bg-white cursor-move"
                    :size="ActionSize::Small"
                    :icon-size="IconSize::Small"
                    x-sortable-handle
                />
            @endif

            <x-filament-architect::icon-button
                :action="$getAction('editBlock')"
                :state-path="$statePath"
                :arguments="[
                    'uuid' => $uuid,
                    'row' => $rowKey,
                    'block' => $block,
                    'blockClassName' => $blockClassName,
                    'locales' => $locales,
                ]"
            />

            <x-filament-architect::icon-button
                color="danger"
                :action="$getAction('deleteBlock')"
                :state-path="$statePath"
                :arguments="[
                    'uuid' => $uuid,
                    'row' => $rowKey,
                ]"
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

        {{-- @if (! $loop->last)
            <div

            >
                <x-filament::icon-button
                    color="gray"
                    icon="heroicon-o-chevron-left"
                    class="border-2 bg-white"
                    :size="ActionSize::Small"
                    :icon-size="IconSize::Small"
                />
                <x-filament::icon-button
                    color="gray"
                    icon="heroicon-o-chevron-right"
                    class="border-2 bg-white"
                    :size="ActionSize::Small"
                    :icon-size="IconSize::Small"
                />
            </div>
        @endif --}}
    </div>
</div>
