<?php

use Codedor\FilamentArchitect\Filament\Architect\TableBlock;

beforeEach(function () {
    $this->tableBlock = new TableBlock();
});

it('has a schema', function () {
    expect($this->tableBlock)
        ->schema()->toBe([]);
});
