<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\Filament\Components\ButtonComponent;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

class ButtonBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('buttons')
                ->tabs([
                    Tab::make('Settings')
                        ->schema([
                            Radio::make('alignment')
                                ->options([
                                    'left' => 'Left',
                                    'center' => 'Center',
                                    'right' => 'Right',
                                ]),
                        ]),
                    Tab::make('General')
                        ->schema([
                            Repeater::make('buttons')
                                ->schema([
                                    ButtonComponent::make('button'),
                                ])
                                ->minItems(1)
                                ->maxItems(3)
                                ->grid(3),
                        ]),
                ]),
        ];
    }
}
