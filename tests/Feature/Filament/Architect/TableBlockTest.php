<?php

use Wotz\FilamentArchitect\Filament\Architect\TableBlock;
use Filament\Forms\Components\RichEditor;

beforeEach(function () {
    $this->tableBlock = new TableBlock();
});

it('has a schema', function () {
    expect($this->tableBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(RichEditor::class),
        );
});
