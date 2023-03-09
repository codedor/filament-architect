<?php

namespace Codedor\FilamentArchitect;

use Filament\Forms\Components\Builder\Block;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class BlockCollection extends Collection
{
    public function fromConfig(): self
    {
        collect(config('filament-architect.default-blocks', []))
            ->each(function ($blockClass) {
                $class = new $blockClass();

                $this->items[$class->getName()] = $class;
            });

        return $this;
    }

    public function filamentBlocks(): array
    {
        return $this->map(function ($block) {
            return Block::make($block->getName())
                ->schema($block->schema());
            })
            ->toArray();
    }

    public function render(array $blocks): View
    {
        return view('architect.index')
            ->with(
                'blocks',
                collect($blocks)
                    ->filter(fn (array $blockData) => $this->has($blockData['type']))
                    ->map(function (array $blockData) {
                        $block = clone $this->get($blockData['type']);
                        return $block->setData($blockData)->render();
                    })
            );
    }
}
