<?php

use Codedor\FilamentArchitect\Filament\BuilderBlocks\CardBlock;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

beforeEach(function () {
    $this->cardBlock = new CardBlock();
});

it('has a schema', function () {
    expect($this->cardBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(TextInput::class),
            fn ($component) => $component
                ->toBeInstanceOf(Repeater::class),
        );
});
