@php
    use Filament\Support\Enums\ActionSize;
    use Filament\Support\Enums\IconSize;

    $state = $getState() ?? [];
    $statePath = $getStatePath();
    $locales = $getLocales();
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div class="flex flex-col mb-4">
        <div class="flex flex-col gap-6">
            <x-filament-architect::add-row-button
                :action="$getAction('addBlock')"
                :state-path="$getStatePath()"
                :arguments="['row' => -1]"
                :shown="count($state) === 0"
                :label="count($state) === 0 ? __('filament-architect::admin.start from scratch') : __('filament-architect::admin.insert block')"
                :aligned="count($state) === 0 ? 'left' : 'center'"
            >
                @if (count($state) === 0 && $getHasTemplates())
                    {{ $getAction('startFromTemplate') }}
                @endif
            </x-filament-architect::add-row-button>
        </div>

        <div
            class="w-full flex flex-col gap-2"
            x-sortable
            x-on:end.stop="$wire.dispatchFormEvent('reorder-row', '{{ $statePath }}', {
                newKeys: $event.target.sortable.toArray(),
            })"
        >
            @foreach ($state ?? [] as $rowKey => $row)
                <div
                    class="w-full flex gap-2 px-2 items-center"
                    x-sortable-item="{{ $rowKey }}"
                >
                    <div class="grow flex flex-col gap-2">
                        <div class="grow flex gap-2 items-center">
                            <div class="flex flex-col gap-2">
                                @if (count($row) < $getMaxFieldsPerRow())
                                    <x-filament-architect::icon-button
                                        :action="$getAction('addBlockBetween')"
                                        :state-path="$getStatePath()"
                                        :arguments="['row' => $rowKey, 'insertAfter' => 0]"
                                    />
                                @endif

                                @if (count($state) > 1)
                                    <x-filament::icon-button
                                        color="gray"
                                        icon="heroicon-o-arrows-up-down"
                                        class="border-2 dark:bg-white/5 dark:hover:bg-white/10 dark:border-gray-700 cursor-move m-0"
                                        :size="ActionSize::Small"
                                        :icon-size="IconSize::Small"
                                        x-sortable-handle
                                    />
                                @endif
                            </div>

                            <div
                                class="grow w-full grid gap-2 grid-cols-12"
                                x-sortable
                                x-on:end.stop="$wire.dispatchFormEvent('reorder-column', '{{ $statePath }}', {
                                    newKeys: $event.target.sortable.toArray(),
                                    row: '{{ $rowKey }}',
                                })"
                            >
                                @foreach ($row as $uuid => $block)
                                    <x-filament-architect::input-row
                                        :uuid="$uuid"
                                        :row="$row"
                                        :row-key="$rowKey"
                                        :block="$block"
                                        :blocks="$getBlocks()"
                                        :locales="$locales"
                                        :state-path="$statePath"
                                        :get-action="$getAction"
                                        :can-add-fields="count($row) < $getMaxFieldsPerRow()"
                                        :has-duplicate-action="$getHasDuplicateAction()"
                                        :loop="$loop"
                                        :has-shown-button="$getHasShownButton()"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <x-filament-architect::add-row-button
                            :action="$getAction('addBlock')"
                            :state-path="$getStatePath()"
                            :arguments="['row' => $rowKey]"
                            :shown="$loop->last"
                        >
                            @if ($loop->last && $getHasPreview())
                                {{ $getAction('architectPreview') }}
                            @endif

                            @if ($loop->last && $getHasTemplates())
                                {{ $getAction('saveAsTemplate') }}
                            @endif
                        </x-filament-architect::add-row-button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-dynamic-component>
