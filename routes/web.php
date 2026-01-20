<?php

use Wotz\FilamentArchitect\Facades\BlockCollection;
use Illuminate\Support\Facades\Route;

if (app()->environment('local')) {
    // Route::view(
    //     'architect-test',
    //     'filament-architect::preview',
    //     [
    //         'blocks' => BlockCollection::map(fn ($block, $name) => [
    //             'type' => $name,
    //             'data' => $block->fake(),
    //         ]),
    //     ]
    // );
}
