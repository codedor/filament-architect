<?php

namespace Codedor\FilamentArchitect\Filament\Components;

use Filament\Forms\Components\Concerns\HasAffixes;
use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Forms\Components\Contracts\HasAffixActions;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;

class ButtonField extends Field implements HasAffixActions
{
    use HasAffixes;
    use HasExtraAlpineAttributes;
    use HasExtraInputAttributes;

    /**
     * @var view-string
     */
    protected string $view = 'filament-architect::components.button-field';
}
