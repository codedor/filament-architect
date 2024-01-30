@dump($alignment)
@dump($image['type'])
@dump($description)

<div class="container">
    <div
        @class([
            'row',
            'flex-lg-row-reverse' => $alignment === 'right'
        ])
    >
        <div class="col-lg-6">
            @if ($image['type'] === 'video')
                <x-general.video :video="$image" />
            @else
                <x-filament-media-library::picture :$image :alt="$image->alt" />
            @endif
        </div>
        <div class="col-lg-6">
            {!! $description !!}
        </div>
    </div>
</div>
