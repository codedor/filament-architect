<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Awcodes\FilamentOembed\Forms\Components\OEmbed;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;

class VideoTextBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('media-text')
                ->tabs([
                    Tab::make('Settings')
                        ->schema([
                            Radio::make('alignment')
                                ->options([
                                    'left' => 'Left',
                                    'right' => 'Right',
                                ])
                                ->default('left'),
                        ]),
                    Tab::make('General')
                        ->schema([
                            OEmbed::make('video'),
                            TiptapEditor::make('description')
                                ->required(),
                        ]),
                ]),
        ];
    }
}
