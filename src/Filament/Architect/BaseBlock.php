<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Illuminate\Support\Str;
use Illuminate\View\View;

abstract class BaseBlock
{
    private ?string $name = null;

    protected ?string $view = null;

    private array $data = [];

    abstract public function schema(): array;

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

        $file = 'architect.' . Str::of($this->getName())->snake('-');
        if (view()->exists("filament-architect::{$file}")) {
            return "filament-architect::{$file}";
        }

        return $file;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setView(string $viewName): self
    {
        $this->view = $viewName;

        return $this;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function render()
    {
        return view($this->getViewName())
            ->with('data', $this->data);
    }
}
