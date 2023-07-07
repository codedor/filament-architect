<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Filament\Forms\Components\Textarea;

class EmbedBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Textarea::make('embed'),
        ];
    }
}
