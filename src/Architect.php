<?php

namespace Codedor\FilamentArchitect;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Stringable;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @implements \Illuminate\Contracts\Support\Arrayable<TKey, TValue>
 */
class Architect implements Arrayable, Htmlable, Stringable
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

    public function toHtml(): View
    {
        $blocks = collect($this->blocks)->map(function (array $row) {
            $blocks = collect($row)
                ->filter(fn (array $blockData) => $blockData['data'][app()->getLocale()]['online'] ?? false)
                ->map(function (array $blockData) {
                    $block = $blockData['type']::make()->render(
                        data: $blockData['data'],
                        translations: $blockData['data'][app()->getLocale()] ?? [],
                    );

                    return $block;
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

    public function toArray()
    {
        return $this->blocks;
    }

    public function __toString()
    {
        return $this->toHtml();
    }
}
