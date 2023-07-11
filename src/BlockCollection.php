<?php

namespace Codedor\FilamentArchitect;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

/**
 * @template TKey of array-key
 * @template TValue of \Codedor\FilamentArchitect\Filament\Architect\BaseBlock
 *
 * @extends Collection<TKey, TValue>
 */
class BlockCollection extends Collection
{
    /**
     * Run a map over each of the items.
     *
     * @return static<TKey, TValue>
     */
    public function fromConfig(): self
    {
        collect((array) config('filament-architect.default-blocks', []))
            ->each(function ($blockClass): void {
                /** @var TValue $class */
                $class = $blockClass::make();

                $this->put($class->getName(), $class);
            });

        return $this;
    }

    /**
     * Run a map over each of the items.
     */
    public function filamentBlocks(): array
    {
        return $this->map->toFilament()
            ->toArray();
    }

    public function render(array $blocks): View
    {
        return view('filament-architect::overview')
            ->with(
                'blocks',
                collect($blocks)
                    ->filter(fn (array $blockData) => $this->has($blockData['type']))
                    ->map(function (array $blockData) {
                        /** @var TValue $block */
                        $block = $this->get($blockData['type']);
                        $block = clone $block;

                        return $block->data($blockData)->render();
                    })
            );
    }
}
