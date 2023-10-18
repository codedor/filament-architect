<?php

namespace Codedor\FilamentArchitect\Engines;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Stringable;

abstract class RenderEngine implements Arrayable, Htmlable, Stringable
{
    abstract public function toHtml(): View;

    public function __construct(public array $blocks = [])
    {
        //
    }

    public static function make(array|string $blocks): static|string
    {
        // Return string if we are in Filament
        if (is_string($blocks)) {
            return $blocks;
        }

        return new static($blocks);
    }

    public function toArray()
    {
        return $this->blocks;
    }

    public function __toString()
    {
        return $this->toHtml();
    }
}
