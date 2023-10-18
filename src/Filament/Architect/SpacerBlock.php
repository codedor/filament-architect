<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Filament\Forms\Components\TextInput;
use Illuminate\View\View;

class SpacerBlock extends BaseBlock
{
    public function render(array $data): ?View
    {
        return view('filament-architect::architect.spacer-block', [
            'height' => $data['height'] ?? null,
        ]);
    }

    public function schema(): array
    {
        return [
            TextInput::make('height')
                ->numeric()
                ->default(32),
        ];
    }
}
