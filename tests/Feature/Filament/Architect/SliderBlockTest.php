<?php

use Wotz\FilamentArchitect\Filament\Architect\SliderBlock;
use Filament\Forms\Components\Repeater;

beforeEach(function () {
    $this->sliderBlock = new SliderBlock();
});

it('has a schema', function () {
    expect($this->sliderBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Repeater::class),
        );
});
