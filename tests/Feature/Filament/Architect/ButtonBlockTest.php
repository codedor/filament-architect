<?php

use Codedor\FilamentArchitect\Filament\Architect\ButtonBlock;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->buttonBlock = new ButtonBlock();
});

it('has a schema', function () {
    expect($this->buttonBlock)
        ->schema()->sequence(
            fn ($field) => $field
                ->toBeInstanceOf(Radio::class)
                ->getOptions()->toHaveCount(3),
            fn ($field) => $field
                ->toBeInstanceOf(Repeater::class),
        );
});
