<?php

namespace Codedor\FilamentArchitect;

use App\Formats\Card;

class ArchitectFormats
{
    public static function get(): array
    {
        return collect(config('filament-architect.attachmentFormats', []))
            ->map(function ($format) {
                return $format::make();
            })
            ->all();
    }
}
