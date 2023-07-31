<?php

namespace Codedor\FilamentArchitect\Filament\Components;

use Closure;
use Filament\Forms\Components\Concerns\HasAffixes;
use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Forms\Components\Contracts\CanHaveNumericState;
use Filament\Forms\Components\Contracts\HasAffixActions;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;
use Filament\Support\RawJs;

class ButtonField extends Field implements HasAffixActions
{
    use HasAffixes;
    use HasExtraInputAttributes;
    use HasExtraAlpineAttributes;

    /**
     * @var view-string
     */
    protected string $view = 'filament-architect::components.button-field';
}
