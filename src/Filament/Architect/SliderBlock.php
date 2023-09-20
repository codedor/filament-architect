<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\ArchitectFormats;
use Codedor\MediaLibrary\Filament\AttachmentInput;
use Filament\Forms\Components\Repeater;

class SliderBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Repeater::make('slider')
                ->schema([
                    AttachmentInput::make('image')
                        ->allowedFormats(ArchitectFormats::get()),
                ])
                ->minItems(1)
                ->grid(3),
        ];
    }
}
