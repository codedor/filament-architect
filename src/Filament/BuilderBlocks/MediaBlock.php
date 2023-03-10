<?php

namespace Codedor\FilamentArchitect\Filament\BuilderBlocks;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;

class MediaBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('buttons')
                ->tabs([
                    Tabs\Tab::make('Settings')
                        ->schema([
                            Radio::make('width')
                                ->options([
                                    'full-width' => 'Full width',
                                    'container' => 'Container',
                                ]),
                        ]),
                    Tabs\Tab::make('General')
                        ->schema([
                            Repeater::make('images')
                                ->schema([
                                    TextInput::make('image'),
                                ]),
                        ]),
                ]),
        ];
    }
}
