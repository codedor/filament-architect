<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;

class MediaBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('buttons')
                ->tabs([
                    Tab::make('Settings')
                        ->schema([
                            Radio::make('width')
                                ->options([
                                    'full-width' => 'Full width',
                                    'container' => 'Container',
                                ]),
                        ]),
                    Tab::make('General')
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
