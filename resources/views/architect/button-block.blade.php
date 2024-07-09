@php
    $alignmentClass = [
        'left' => 'text-start',
        'center' => 'text-center',
        'right' => 'text-end'
    ][$alignment];
@endphp

@if ($buttons && count($buttons))
    <div
        @class(['container', $alignmentClass])
    >
        <div class="d-inline-flex flex-wrap gap-4">
            @foreach ($buttons as $button)
                <x-general.button :button="$button" />
            @endforeach
        </div>
    </div>
@endif
