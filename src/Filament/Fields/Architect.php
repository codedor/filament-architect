<?php

namespace Codedor\FilamentArchitect\Filament\Fields;

use Codedor\FilamentArchitect\Facades\BlockCollection;
use Filament\Forms\Components\Builder;

class Architect extends Builder
{
    public function excludeBlocks(array $blocksToExclude): self
    {
        $blocksToExclude = collect($blocksToExclude)->map(fn ($block) => class_basename($block));

        $blocks = collect($this->getChildComponents())
            ->filter(function ($block, $name) use ($blocksToExclude) {
                return $blocksToExclude->has($name);
            })
            ->toArray();

        $this->blocks($blocks);

        return $this;
    }

    public function addBlocks(array $blocksToAdd): self
    {
        $blocks = $this->getChildComponents();

        foreach ($blocksToAdd as $block) {
            if (is_string($block)) {
                $block = $block::make()->toFilament();
            }

            $blocks[] = $block;
        }

        $this->blocks($blocks);

        return $this;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->blocks(BlockCollection::filamentBlocks());

        $this->cloneable();

        $this->collapsed();
    }
}
