<?php

use Illuminate\Support\Str;

if (! function_exists('get_architect_block')) {
    function get_architect_block(string $type): string
    {
        $base = class_basename($type);

        return collect(config('filament-architect.default-blocks'), [])
            ->first(fn (string $blockClass) => Str::endsWith($blockClass, "\\{$base}"))
            ?? $type;
    }
}
