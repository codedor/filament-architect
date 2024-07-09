<div class="flex flex-col items-start">
    <x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
    >
        <input wire:model="{{ $getStatePath() }}" type="hidden" />

        {{ $getAction('addButton') }}
        {{ $getAction('removeButton') }}
    </x-dynamic-component>
</div>
