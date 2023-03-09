<?php

namespace Codedor\FilamentArchitect\Filament\BuilderBlocks;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;

class Heading extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('Heading')
                ->tabs([
                    Tabs\Tab::make('Settings')
                        ->schema([
                            Select::make('level')
                                ->options([
                                    'h1' => 'Heading 1',
                                    'h2' => 'Heading 2',
                                    'h3' => 'Heading 3',
                                    'h4' => 'Heading 4',
                                    'h5' => 'Heading 5',
                                    'h6' => 'Heading 6',
                                ])
                                ->required(),
                        ]),
                    Tabs\Tab::make('General')
                        ->schema([
                            TextInput::make('content')
                                ->label('Heading')
                                ->required(),
                        ]),
                ]),
            ];
    }
}
