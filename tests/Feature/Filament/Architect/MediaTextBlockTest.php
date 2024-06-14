<?php

use Codedor\FilamentArchitect\Filament\Architect\MediaTextBlock;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

beforeEach(function () {
    $this->mediaTextBlock = new MediaTextBlock();
});

it('has a schema', function () {
    expect($this->mediaTextBlock)
        ->schema()->sequence(
            fn ($field) => $field
                ->toBeInstanceOf(\Filament\Forms\Components\Radio::class),
            fn ($field) => $field
                ->toBeInstanceOf(\Codedor\MediaLibrary\Filament\AttachmentInput::class),
        );
});
