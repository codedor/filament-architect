<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\ArchitectFormats;
use Codedor\FilamentArchitect\Filament\Components\ButtonComponent;
use Codedor\MediaLibrary\Filament\AttachmentInput;
use Codedor\MediaLibrary\Models\Attachment;
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
                    AttachmentInput::make('image')
                        ->allowedFormats(ArchitectFormats::get()),
                    TextInput::make('title'),
                    TiptapEditor::make('description'),
                    ButtonComponent::make('button'),
                ])
                ->grid()
                ->minItems(1),
        ];
    }

    public function getData(): array
    {
        if ($this->data['data']['image']) {
            $this->data['data']['image'] = Attachment::find($this->data['data']['image']);
        }

        return $this->data;
    }
}
