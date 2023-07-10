<?php

use Codedor\FilamentArchitect\Filament\Architect\TableBlock;
use FilamentTiptapEditor\TiptapEditor;

beforeEach(function () {
    $this->tableBlock = new TableBlock();
});

it('has a schema', function () {
    expect($this->tableBlock)
        ->schema()->sequence(
            fn ($component) => $component
                ->toBeInstanceOf(TiptapEditor::class),
        );
});
