<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

abstract class BaseBlock
{
    protected ?string $name = null;

    abstract public function schema(): array;

    public static function make()
    {
        return new static();
    }

    public function getName()
    {
        return $this->name ?? class_basename(static::class);
    }
}
