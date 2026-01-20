<?php

namespace Wotz\FilamentArchitect\Tests\Fixtures\Blocks;

use Wotz\FilamentArchitect\Filament\Architect\BaseBlock;

class TestBlock extends BaseBlock
{
    // protected ?string $view = 'test-block';

    public function schema(): array
    {
        return [];
    }
}
