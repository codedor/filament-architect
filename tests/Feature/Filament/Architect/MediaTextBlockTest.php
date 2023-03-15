<?php

use Codedor\FilamentArchitect\Filament\Architect\MediaTextBlock;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->mediaTextBlock = new MediaTextBlock();
});

it('has a schema', function () {
    expect($this->mediaTextBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Tabs::class)
                ->getChildComponents()->sequence(
                    fn ($tab) => $tab
                        ->toBeInstanceOf(Tab::class)
                ),
        );
});
