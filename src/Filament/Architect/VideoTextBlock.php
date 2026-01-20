<?php

namespace Wotz\FilamentArchitect\Filament\Architect;

use Wotz\FilamentImageOrVideo\Filament\Components\VideoEmbed;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
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

            VideoEmbed::make('video'),

            RichEditor::make('description')
                ->label('Text')
                ->required(),
        ];
    }
}
