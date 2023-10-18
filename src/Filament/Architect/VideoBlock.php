<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Awcodes\FilamentOembed\Forms\Components\OEmbed;
use Illuminate\View\View;

class VideoBlock extends BaseBlock
{
    public function render(array $data): ?View
    {
        return view('filament-architect::architect.video-block', [
            'video' => $data['video'] ?? null,
        ]);
    }

    public function schema(): array
    {
        return [
            OEmbed::make('video'),
        ];
    }
}
