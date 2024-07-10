<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentImageOrVideo\Filament\Components\VideoEmbed;
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
            VideoEmbed::make('video'),
        ];
    }
}
