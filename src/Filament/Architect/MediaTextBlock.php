<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\ArchitectFormats;
use Codedor\MediaLibrary\Filament\AttachmentInput;
use Codedor\MediaLibrary\Models\Attachment;
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
                            AttachmentInput::make('image')
                                ->allowedFormats(ArchitectFormats::get())
                                ->required(),
                            TiptapEditor::make('description'),
                        ]),
                ]),
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
