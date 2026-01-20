<?php

use Wotz\FilamentArchitect\Enums\WidthOptions;

it('has a toSelect method', function () {
    expect(WidthOptions::toSelect())
        ->toBe([
            'full_width' => __('filament-architect::width-options.full width'),
            'container' => __('filament-architect::width-options.container'),
            'text_container' => __('filament-architect::width-options.text container'),
        ]);
});

it('has a toSelectForMaxImages method', function () {
    expect(WidthOptions::toSelectForMaxImages())
        ->toBe([
            'full_width' => __('filament-architect::width-options.full width'),
            'container' => __('filament-architect::width-options.container'),
        ]);
});
