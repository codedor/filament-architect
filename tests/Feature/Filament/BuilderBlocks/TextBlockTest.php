<?php

use Codedor\FilamentArchitect\Filament\BuilderBlocks\TextBlock;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->textBlock = new TextBlock();
});

it('has a schema', function () {
    expect($this->textBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Tabs::class)
                ->getChildComponents()->sequence(
                    fn ($tab) => $tab
                        ->toBeInstanceOf(Tab::class)
                ),
        );
});
