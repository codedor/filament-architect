<?php

use Codedor\FilamentArchitect\Filament\Architect\SpacerBlock;
use Codedor\FilamentArchitect\Filament\Architect\TableBlock;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

beforeEach(function () {
    $this->tableBlock = new TableBlock();
});

it('has a schema', function () {
    expect($this->tableBlock)
        ->schema()->toBe([]);
});
