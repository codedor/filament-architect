<?php

use Codedor\FilamentArchitect\Filament\BuilderBlocks\SpacerBlock;
use Codedor\FilamentArchitect\Filament\BuilderBlocks\TableBlock;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

beforeEach(function () {
    $this->tableBlock = new TableBlock();
});

it('has a schema', function () {
    expect($this->tableBlock)
        ->schema()->toBe([]);
});
