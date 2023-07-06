<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Awcodes\FilamentOembed\Forms\Components\OEmbed;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;

class VideoBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            OEmbed::make('video'),
        ];
    }
}
