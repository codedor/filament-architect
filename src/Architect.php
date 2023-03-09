<?php

namespace Codedor\FilamentArchitect;

use Codedor\FilamentArchitect\Facades\BlockCollection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

class Architect implements Htmlable, Arrayable
{
    public function __construct(
        private array $blocks
    ) {
    }

    public static function make(array|string $blocks): self|string
    {
        if (is_string($blocks)) {
            return $blocks;
        }

        return new self($blocks);
    }

    public function toHtml()
    {
        return BlockCollection::render($this->blocks);
    }

    public function toArray()
    {
        return $this->blocks;
    }
}
