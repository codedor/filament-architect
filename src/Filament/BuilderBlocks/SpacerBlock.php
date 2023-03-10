<?php

namespace Codedor\FilamentArchitect\Filament\BuilderBlocks;

use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;

class SpacerBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            TextInput::make('height')
                ->numeric()
                ->default(32),
        ];
    }
}
