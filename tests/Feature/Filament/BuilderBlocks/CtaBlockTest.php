<?php

use Codedor\FilamentArchitect\Filament\BuilderBlocks\CtaBlock;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->ctaBlock = new CtaBlock();
});

it('has a schema', function () {
    expect($this->ctaBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Tabs::class)
                ->getChildComponents()->sequence(
                    fn ($tab) => $tab
                        ->toBeInstanceOf(Tab::class)
                ),
        );
});
