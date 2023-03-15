<?php

use Codedor\FilamentArchitect\Filament\BuilderBlocks\SpacerBlock;
use Filament\Forms\Components\TextInput;

beforeEach(function () {
    $this->spacerBlock = new SpacerBlock();
});

it('has a schema', function () {
    expect($this->spacerBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(TextInput::class),
        );
});
