<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Filament\Forms\Components\Textarea;
use Illuminate\View\View;

class EmbedBlock extends BaseBlock
{
    public function render(array $data): ?View
    {
        return view('filament-architect::architect.embed-block', [
            'embed' => $data['embed'] ?? '',
        ]);
    }

    public function schema(): array
    {
        return [
            Textarea::make('embed')
                ->label('Embed code'),
        ];
    }
}
