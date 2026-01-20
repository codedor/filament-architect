<?php

namespace Wotz\FilamentArchitect\Filament\Architect;

use Wotz\FilamentImageOrVideo\Filament\Components\VideoEmbed;
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
