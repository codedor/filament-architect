<?php

namespace Codedor\FilamentArchitect\Tests\Fixtures\Blocks;

use Codedor\FilamentArchitect\Filament\BuilderBlocks\BaseBlock;

class TestBlock extends BaseBlock
{
    // protected ?string $view = 'test-block';

    public function schema(): array
    {
        return [];
    }
}
