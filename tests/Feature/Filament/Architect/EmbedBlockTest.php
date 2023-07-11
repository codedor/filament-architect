<?php

use Codedor\FilamentArchitect\Filament\Architect\EmbedBlock;
use Filament\Forms\Components\Textarea;

beforeEach(function () {
    $this->embedBlock = new EmbedBlock();
});

it('has a schema', function () {
    expect($this->embedBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Textarea::class),
        );
});
