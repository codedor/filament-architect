<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Illuminate\Support\Str;
use Illuminate\View\View;

abstract class BaseBlock
{
    protected ?string $name = null;

    public array $locales = [];

    abstract public function schema(): array;

    public static function make()
    {
        return new static();
    }

    public function getName()
    {
        return $this->name ?? Str::headline(class_basename(static::class));
    }

    public function locales(array $locales): self
    {
        $this->locales = $locales;

        return $this;
    }

    public function getLocales(): array
    {
        return $this->locales;
    }

    public function render(array $data): ?View
    {
        return null;
    }
}
