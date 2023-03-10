<?php

namespace Codedor\FilamentArchitect\Filament\BuilderBlocks;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;

class VideoBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('video')
                ->tabs([
                    Tabs\Tab::make('Video link')
                        ->schema([
                            Radio::make('type')
                                ->options([
                                    'youtube' => 'Youtube',
                                    'vimeo' => 'Vimeo',
                                ]),
                            TextInput::make('url')
                                ->placeholder('Video ID or URL'),
                        ]),
                    Tabs\Tab::make('Player Settings')
                        ->schema([
                            Checkbox::make('autoplay'),
                            Checkbox::make('muted'),
                            Checkbox::make('loop'),
                            Checkbox::make('fullscreen'),
                            Checkbox::make('show_info'),
                            Checkbox::make('modest_branding'),
                        ]),
                    Tabs\Tab::make('Layout')
                        ->schema([
                            TextInput::make('width')
                                ->numeric()
                                ->suffix('%')
                                ->helperText('Width of the video iframe in %'),
                        ]),
                ]),
        ];
    }
}
