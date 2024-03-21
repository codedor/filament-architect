<div class="content-padding">
    <div class="container">
        @if (count($images))
            <x-general.slider>
                @foreach ($images as $image)
                    <div class="splide__slide">
                        <x-filament-media-library::picture
                            :$image
                            :alt="$image->alt"
                            :lazyload
                        />
                    </div>
                @endforeach
            </x-general.slider>
        @endif
    </div>
</div>
