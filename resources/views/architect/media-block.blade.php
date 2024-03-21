<div class="content-padding">
    @if($width !== 'full_width')
        <div class="container">
            @endif
            <div class="row justify-content-center">
                <div @class([
                    'col-12',
                    'col-lg-10' => $width === 'text_container',
                  ])>
                    <div class="row">
                        @foreach($images as $image)
                            <div @class([
                            'col-md-6 col-lg-' . 12 / count($images),
                          ])>
                                @if ($image['type'] === 'video')
                                    <x-general.video :video="$image" />
                                @else
                                    <x-filament-media-library::picture :$image :alt="$image->alt" />
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if($width !== 'full')
        </div>
    @endif
</div>
