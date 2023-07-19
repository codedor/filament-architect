<?php

namespace Codedor\FilamentArchitect;

use Codedor\FilamentArchitect\Facades\BlockCollection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Stringable;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @implements \Illuminate\Contracts\Support\Arrayable<TKey, TValue>
 */
class Architect implements Htmlable, Arrayable, Stringable
{
    public function __construct(
        private array $blocks
    ) {
    }

    /**
     * @return string|static<TKey, TValue>
     */
    public static function make(array|string $blocks): self|string
    {
        if (is_string($blocks)) {
            return $blocks;
        }

        return new self($blocks);
    }

    public function toHtml(): string
    {
        return BlockCollection::render($this->blocks)->render();
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
