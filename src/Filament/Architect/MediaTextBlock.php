<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\ArchitectFormats;
use Codedor\MediaLibrary\Filament\AttachmentInput;
use Codedor\MediaLibrary\Models\Attachment;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\View\View;

class MediaTextBlock extends BaseBlock
{
    protected ?string $name = 'Media & Text Block';

    public function render(array $data): ?View
    {
        return view('filament-architect::architect.media-text-block', [
            'alignment' => $data['alignment'] ?? '',
            'image' => Attachment::find($data['image'] ?? null),
            'description' => $data['description'] ?? '',
        ]);
    }

    public function schema(): array
    {
        return [
            Radio::make('alignment')
                ->default('left')
                ->options([
                    'left' => 'Left',
                    'right' => 'Right',
                ])
                ->inline()
                ->inlineLabel(false)
                ->default('left')
                ->formatStateUsing(fn (mixed $state) => $state ?? 'left'),

            AttachmentInput::make('image')
                ->allowedFormats(ArchitectFormats::get())
                ->required(),
        ];
    }
}
