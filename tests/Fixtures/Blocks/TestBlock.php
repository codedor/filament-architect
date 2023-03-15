<?php

namespace Codedor\FilamentArchitect\Tests\Fixtures\Blocks;

use Codedor\FilamentArchitect\Filament\Architect\BaseBlock;

class TestBlock extends BaseBlock
{
    // protected ?string $view = 'test-block';

    public function schema(): array
    {
        return [];
    }
}
