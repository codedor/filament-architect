<?php

namespace Codedor\FilamentArchitect\Engines;

use Illuminate\View\View;

class Architect extends RenderEngine
{
    public function toHtml(): View
    {
        $blocks = collect($this->blocks)->map(function (array $row) {
            $blocks = collect($row)
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
        ]);
    }
}
