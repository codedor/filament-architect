<?php

use Wotz\FilamentArchitect\Filament\Architect\TextBlock;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Schemas\Components\Grid;

beforeEach(function () {
    $this->textBlock = new TextBlock();
});

it('has a schema', function () {
    expect($this->textBlock)
        ->schema()->sequence(
            fn ($field) => $field
                ->toBeInstanceOf(\Filament\Forms\Components\TextInput::class),
            fn ($field) => $field
                ->toBeInstanceOf(Grid::class),
        );
});
