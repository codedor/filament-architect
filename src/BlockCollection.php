<?php

namespace Codedor\FilamentArchitect;

use Illuminate\Support\Collection;

class BlockCollection extends Collection
{
    public function fromConfig(): self
    {
        $config = (array) config('filament-architect.default-blocks', []);

        collect($config)
            ->keys()
            ->each(fn ($blockClass) => $this->add($blockClass::make()));

        return $this->filter()->unique();
    }
}
