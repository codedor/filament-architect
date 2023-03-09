<?php

namespace Codedor\FilamentArchitect\Facades;

use Codedor\FilamentArchitect\BlockCollection as Blocks;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Codedor\FilamentArchitect\BlockCollection
 */
class BlockCollection extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Blocks::class;
    }
}
