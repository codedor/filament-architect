<?php

use Codedor\FilamentArchitect\Filament\Architect\VideoBlock;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->videoBlock = new VideoBlock();
});

it('has a schema', function () {
    expect($this->videoBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(\Filament\Forms\Components\Fieldset::class),
        );
});
