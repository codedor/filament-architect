<?php

namespace Codedor\FilamentArchitect\Filament\BuilderBlocks;

use Illuminate\Support\Str;
use Illuminate\View\View;

abstract class BaseBlock
{
    private ?string $name = null;

    private ?string $view = null;

    private array $data = [];

    abstract public function schema(): array;

    public function render(): View
    {
        return view($this->getViewName())
            ->with('data', $this->data);
    }

    public function name(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        if (! $this->name) {
            return class_basename(static::class);
        }

        return $this->name;
    }

    public function getViewName(): string
    {
        if ($this->view) {
            return $this->view;
        }

        return 'filament-architect::architect.' . Str::of($this->getName())->snake('-');
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function data(): array
    {
        return $this->data;
    }
}
