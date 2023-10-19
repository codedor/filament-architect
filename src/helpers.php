<?php

use Codedor\FilamentArchitect\Filament\Architect\BaseBlock;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

if (! function_exists('get_architect_block')) {
    function get_architect_block(array|Collection $blocks, string $type): string
    {
        $base = class_basename($type);

        return Collection::wrap($blocks)
            ->map(fn (string|BaseBlock $block) => is_string($block) ? $block : $block::class)
            ->first(fn (string $blockClass) => Str::endsWith($blockClass, "\\{$base}"))
                ?? $type;
    }
}
