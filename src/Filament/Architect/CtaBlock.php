<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\Filament\Components\ButtonComponent;
use Filament\Forms\Components\TextInput;

class CtaBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            TextInput::make('title'),
            ButtonComponent::make('button'),
        ];
    }
}
