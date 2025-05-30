<?php

use Codedor\FilamentArchitect\Filament\Architect\VideoTextBlock;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Fieldset;

beforeEach(function () {
    $this->videoTextBlock = new VideoTextBlock();
});

it('has a schema', function () {
    expect($this->videoTextBlock)
        ->schema()->sequence(
            fn ($field) => $field
                ->toBeInstanceOf(\Filament\Forms\Components\Radio::class),
            fn ($field) => $field
                ->toBeInstanceOf(Fieldset::class),
            fn ($field) => $field
                ->toBeInstanceOf(RichEditor::class),
        );
});
