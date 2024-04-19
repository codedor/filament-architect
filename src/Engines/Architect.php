<?php

namespace Codedor\FilamentArchitect\Engines;

class Architect extends RenderEngine
{
    public function toHtml(): string
    {
        $blocks = collect($this->blocks)->map(function (array $row) {
            $blocks = collect($row)
                ->filter(fn ($block) => $block['shown'] ?? true)
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
                    );
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
}
