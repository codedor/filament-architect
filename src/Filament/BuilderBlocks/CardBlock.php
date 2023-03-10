<?php

namespace Codedor\FilamentArchitect\Filament\BuilderBlocks;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class CardBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            TextInput::make('title'),
            Repeater::make('cards')
                ->schema([
                    TextInput::make('cover_image'),
                    TextInput::make('title'),
                    MarkdownEditor::make('description'),
                ]),
        ];
    }
}
