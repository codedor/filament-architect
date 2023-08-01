<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\Filament\Components\ButtonComponent;
use Codedor\MediaLibrary\Filament\AttachmentInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;

class CardBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Repeater::make('cards')
                ->schema([
                    AttachmentInput::make('image'),
                    TextInput::make('title'),
                    TiptapEditor::make('description'),
                    ButtonComponent::make('button'),
                ])
                ->grid()
                ->minItems(1),
        ];
    }
}
