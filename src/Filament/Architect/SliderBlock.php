<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\MediaLibrary\Filament\AttachmentInput;
use Filament\Forms\Components\Repeater;

class SliderBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Repeater::make('slider')
                ->schema([
                    AttachmentInput::make('image'),
                ])
                ->minItems(1)
                ->grid(3),
        ];
    }
}
