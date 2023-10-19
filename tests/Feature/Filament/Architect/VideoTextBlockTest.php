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
            fn ($field) => $field
                ->toBeInstanceOf(\Filament\Forms\Components\Radio::class),
            fn ($field) => $field
                ->toBeInstanceOf(\Filament\Forms\Components\Fieldset::class),
            fn ($field) => $field
                ->toBeInstanceOf(\FilamentTiptapEditor\TiptapEditor::class),
        );
});
