<?php

use Codedor\FilamentArchitect\Filament\Architect\MediaBlock;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->mediaBlock = new MediaBlock();
});

it('has a schema', function () {
    expect($this->mediaBlock)
        ->schema()->sequence(
            fn ($field) => $field
                ->toBeInstanceOf(Radio::class),
            fn ($field) => $field
                ->toBeInstanceOf(Repeater::class),
        );
});
