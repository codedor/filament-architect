<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div class="grid grid-cols-6 gap-2">
        @foreach ($attachments as $attachment)
            <a href="{{ $attachment->url }}" target="_blank">
                <x-filament-media-library::attachment :$attachment />
            </a>
        @endforeach
    </div>
</x-dynamic-component>
