<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;

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
                                    TextInput::make('text'),
                                    Select::make('type')
                                        ->options([
                                            'filled' => 'Filled button',
                                            'filled-arrow' => 'Filled arrow button',
                                            'outline' => 'Outline button',
                                            'outline-arrow' => 'Outline arrow button',
                                            'ghost' => 'Ghost button',
                                        ]),
                                    TextInput::make('url')
                                        ->url(),
                                    TextInput::make('category'),
                                    Select::make('action')
                                        ->options([
                                            'hit' => 'Hit',
                                            'play' => 'Play',
                                            'pause' => 'Pause',
                                            'download' => 'Download',
                                            'view' => 'View',
                                            'open' => 'Open',
                                            'close' => 'Close',
                                        ]),
                                    TextInput::make('label'),
                                    Checkbox::make('non_interaction'),
                                ]),
                        ]),
                ]),
        ];
    }
}
