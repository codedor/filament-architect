<?php

namespace Wotz\FilamentArchitect\Filament\Fields;

class PageArchitectInput extends ArchitectInput
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->locales([]);

        $this->blocks(
            collect(config('filament-architect.default-blocks', []))
                ->map(fn (string $class) => $class::make())
                ->unique()
                ->filter()
        );
    }
}
