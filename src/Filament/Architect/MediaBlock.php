<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Closure;
use Codedor\MediaLibrary\Components\Fields\AttachmentInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

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
                                ->options(function (Closure $get) {
                                    if (is_array($get('images')) && count($get('images')) > 2) {
                                        return [
                                            'full-width' => 'Full width',
                                            'container' => 'Container',
                                        ];
                                    }

                                    return [
                                        'full-width' => 'Full width',
                                        'container' => 'Container',
                                        'text-container' => 'Text container',
                                    ];
                                }),
                        ]),
                    Tab::make('General')
                        ->schema([
                            Repeater::make('images')
                                ->schema([
                                    AttachmentInput::make('image'),
                                ])
                                ->minItems(1)
                                ->maxItems(3)
                                ->reactive(),
                        ]),
                ]),
        ];
    }
}
