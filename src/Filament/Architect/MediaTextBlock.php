<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\MediaLibrary\Filament\AttachmentInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use FilamentTiptapEditor\TiptapEditor;

class MediaTextBlock extends BaseBlock
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
                            AttachmentInput::make('image'),
                            TiptapEditor::make('description'),
                        ]),
                ]),
        ];
    }
}
