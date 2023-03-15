<?php

use Codedor\FilamentArchitect\Filament\BuilderBlocks\ButtonBlock;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->buttonBlock = new ButtonBlock();
});

it('has a schema', function () {
    expect($this->buttonBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(Tabs::class)
                ->getLabel()->toBe('buttons')
                ->getChildComponents()->sequence(
                    fn ($tab) => $tab
                        ->toBeInstanceOf(Tab::class)
                        ->getLabel()->toBe('Settings')
                        ->getChildComponents()->sequence(
                            fn ($field) => $field
                                ->toBeInstanceOf(Radio::class)
                                ->getName()->toBe('alignment')
                                ->getOptions()->toHaveCount(3),
                        ),
                    fn ($tab) => $tab
                        ->toBeInstanceOf(Tab::class)
                        ->getLabel()->toBe('General')
                ),
        );
});
