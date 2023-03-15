<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class SliderBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Repeater::make('images')
                ->schema([
                    TextInput::make('image'),
                ]),
        ];
    }
}
