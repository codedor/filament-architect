<?php

namespace Codedor\FilamentArchitect\Engines;

use Illuminate\View\View;

class Architect extends RenderEngine
{
    public function toHtml(): View
    {
        $blocks = collect($this->blocks)->map(function (array $row) {
            $blocks = collect($row)->map(function (array $blockData) {
                return get_architect_block($blockData['type'])::make()->render(
                    data: $blockData['data'],
                );
            });

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
