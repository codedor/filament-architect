<?php

namespace Codedor\FilamentArchitect\Filament\Fields;

use Codedor\FilamentArchitect\Facades\BlockCollection;
use Filament\Forms\Components\Builder;

class ExtendedBuilder extends Builder
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->blocks(BlockCollection::filamentBlocks());
    }
}
