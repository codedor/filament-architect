@dump($alignment)
@dd($image['type'])
@dump($description)

<div class="container">
    <div
        @class([
            'row flex-column-reverse flex-md-row justify-content-between',
            'flex-md-row-reverse' => $alignment === 'right'
        ])
    >
        <div class="col-lg-6">
            @if ($image['type'] === 'video')
                <x-video :$image />
            @else
                <x-filament-media-library::picture :$image :alt="$image->alt" />
            @endif
        </div>
        <div class="col-lg-6">

        </div>
    </div>
</div>
