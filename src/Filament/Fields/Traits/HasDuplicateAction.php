<?php

namespace Codedor\FilamentArchitect\Filament\Fields\Traits;

use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Support\Enums\ActionSize;

trait HasDuplicateAction
{
    public Closure|bool $hasDuplicateAction = false;

    public function getDuplicateAction(): \Filament\Actions\Action
    {
        return \Filament\Actions\Action::make('duplicateBlock')
            ->icon('heroicon-o-document-duplicate')
            ->hiddenLabel()
            ->color('gray')
            ->size(\Filament\Support\Enums\Size::Small)
            ->requiresConfirmation()
            ->action(function (array $arguments, self $component) {
                $items = $component->getState();
                $newItem = $items[$arguments['row']];
                array_splice($items, $arguments['row'], 0, [$newItem]);
                $component->state($items);
            });
    }

    public function hasDuplicateAction(Closure|bool $hasDuplicateAction = true): static
    {
        $this->hasDuplicateAction = $hasDuplicateAction;

        return $this;
    }

    public function getHasDuplicateAction(): bool
    {
        return $this->evaluate($this->hasDuplicateAction);
    }
}
