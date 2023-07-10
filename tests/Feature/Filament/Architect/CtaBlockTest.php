<?php

use Codedor\FilamentArchitect\Filament\Architect\CtaBlock;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->ctaBlock = new CtaBlock();
});

it('has a schema', function () {
    expect($this->ctaBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(\Filament\Forms\Components\TextInput::class),
            fn ($component) => $component
                ->toBeInstanceOf(\Filament\Forms\Components\Grid::class)
        );
});
