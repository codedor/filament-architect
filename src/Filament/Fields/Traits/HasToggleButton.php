<?php

namespace Codedor\FilamentArchitect\Filament\Fields\Traits;

use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Support\Enums\Size;

trait HasToggleButton
{
    public Closure|bool $enableShownButton = false;

    public function getEnableBlockAction(string $name = 'enableBlock'): \Filament\Actions\Action
    {
        return \Filament\Actions\Action::make($name)
            ->icon('heroicon-o-eye-slash')
            ->hiddenLabel()
            ->color('gray')
            ->size(\Filament\Support\Enums\Size::Small)
            ->action(function (self $component, array $arguments) {
                $items = $component->getState();
                $items[$arguments['row']][$arguments['uuid']]['shown'] = ! ($items[$arguments['row']][$arguments['uuid']]['shown'] ?? true);
                $component->state($items);
            });
    }

    public function getDisableBlockAction(): \Filament\Actions\Action
    {
        return $this->getEnableBlockAction('disableBlock')
            ->icon('heroicon-o-eye');
    }

    public function enableShownButton(Closure|bool $enableShownButton): static
    {
        $this->enableShownButton = $enableShownButton;

        return $this;
    }

    public function getHasShownButton(): bool
    {
        return $this->evaluate($this->enableShownButton);
    }
}
