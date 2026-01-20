<?php

use Wotz\FilamentArchitect\Filament\Architect\CtaBlock;

beforeEach(function () {
    $this->ctaBlock = new CtaBlock();
});

it('has a schema', function () {
    expect($this->ctaBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(\Filament\Forms\Components\TextInput::class),
            fn ($component) => $component
                ->toBeInstanceOf(\Filament\Forms\Components\ViewField::class)
        );
});
