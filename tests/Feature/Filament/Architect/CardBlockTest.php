<?php

use Wotz\FilamentArchitect\Filament\Architect\CardBlock;
use Filament\Forms\Components\Repeater;

beforeEach(function () {
    $this->cardBlock = new CardBlock();
});

it('has a schema', function () {
    expect($this->cardBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Repeater::class),
        );
});
