<?php

namespace App\Architect;

use Codedor\FilamentArchitect\Filament\Architect\BaseBlock;
use Illuminate\View\View;

class TestBlock extends BaseBlock
{
    protected ?string $name = 'Test Block';

    public function render(array $data): ?View
    {
        return view('architect.test-block', [
            'data' => $data,
        ]);
    }

    public function schema(): array
    {
        return [

        ];
    }
}
