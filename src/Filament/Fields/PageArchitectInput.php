<?php

namespace Codedor\FilamentArchitect\Filament\Fields;

use Codedor\FilamentArchitect\Filament\Architect\TextBlock;

class PageArchitectInput extends ArchitectInput
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->blocks([
            TextBlock::make(),
        ]);
    }
}
