<?php

namespace Codedor\FilamentArchitect;

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
