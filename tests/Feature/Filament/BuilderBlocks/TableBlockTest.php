<?php

use Codedor\FilamentArchitect\Filament\BuilderBlocks\TableBlock;

beforeEach(function () {
    $this->tableBlock = new TableBlock();
});

it('has a schema', function () {
    expect($this->tableBlock)
        ->schema()->toBe([]);
});
