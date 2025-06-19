<?php

use Codedor\FilamentArchitect\Filament\Architect\VideoBlock;
use Filament\Schemas\Components\Fieldset;

beforeEach(function () {
    $this->videoBlock = new VideoBlock();
});

it('has a schema', function () {
    expect($this->videoBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Fieldset::class),
        );
});
