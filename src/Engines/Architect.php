<?php

namespace Codedor\FilamentArchitect\Engines;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Architect extends RenderEngine
{
    public function toHtml(): string
    {
        $blocks = collect($this->blocks)->map(function (array $row) {
            $blocks = collect($row)
                ->when(
                    config('filament-architect.enableShownButton', false),
                    fn ($blocks) => $blocks->filter(fn ($block) => $block['shown'] ?? true)
                )
                ->map(function (array $blockData) {
                    $block = get_architect_block(
                        config('filament-architect.default-blocks', []),
                        $blockData['type'],
                    );

                    if (! class_exists($block)) {
                        return null;
                    }

                    return $block::make()->render(
                        data: $blockData['data'],
                    )->with('slug', self::blockSlug($blockData['data']));
                })
                ->filter();

            if ($blocks->isEmpty()) {
                return null;
            }

            return $blocks;
        })->filter();

        return view('filament-architect::render', [
            'blocks' => $blocks,
        ])->toHtml();
    }

    public function anchorList(): Collection
    {
        return collect($this->blocks)
            ->flatten(1)
            ->mapWithKeys(fn (array $block) => [
                self::blockSlug($block['data']) => data_get($block, 'data.working_title'),
            ])
            ->filter();
    }

    public static function blockSlug(array $block): string
    {
        return data_get($block, 'slug') ?: Str::slug(data_get($block, 'working_title'));
    }
}
