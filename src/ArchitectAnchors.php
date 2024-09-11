<?php

namespace Codedor\FilamentArchitect;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ArchitectAnchors
{
    public static function list(?array $blocks = []): Collection
    {
        return collect($blocks)
            ->flatten(1)
            ->mapWithKeys(fn (array $block) => [
                self::blockSlug($block['data']) => data_get($block, 'data.working_title'),
            ])
            ->filter();
    }

    public static function blockSlug(array $block): string
    {
        return data_get($block, 'slug', Str::slug(data_get($block, 'working_title')));
    }
}
