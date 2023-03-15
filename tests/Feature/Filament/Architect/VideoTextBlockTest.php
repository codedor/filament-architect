<?php

use Codedor\FilamentArchitect\Filament\Architect\VideoTextBlock;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->videoTextBlock = new VideoTextBlock();
});

it('has a schema', function () {
    expect($this->videoTextBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Tabs::class)
                ->getChildComponents()->sequence(
                    fn ($tab) => $tab
                        ->toBeInstanceOf(Tab::class)
                ),
        );
});
