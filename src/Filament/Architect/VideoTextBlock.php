<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Awcodes\FilamentOembed\Forms\Components\OEmbed;
use Filament\Forms\Components\Radio;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\View\View;

class VideoTextBlock extends BaseBlock
{
    public function render(array $data): ?View
    {
        return view('filament-architect::architect.video-text-block', [
            'video' => $data['video'] ?? null,
            'alignment' => $data['alignment'] ?? 'left',
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
                ]),

            OEmbed::make('video'),

            TiptapEditor::make('description')
                ->label('Text')
                ->required(),
        ];
    }
}
