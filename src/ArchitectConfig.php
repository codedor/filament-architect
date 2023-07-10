<?php

namespace Codedor\FilamentArchitect;

use Codedor\FilamentArchitect\Enums\WidthOptionsInterface;

class ArchitectConfig
{
    public function fromConfig(): self
    {
        return $this
            ->widthOptionsEnum(config('filament-architect.widthOptions'))
            ->buttonClasses(config('filament-architect.buttonClasses'))
            ->trackingActions(config('filament-architect.trackingActions'));

        return $this;
    }

    public function widthOptionsEnum(string|null $enumClass): self
    {
        if ($enumClass === null) {
            $this->widthOptionsEnum = null;

            return $this;
        }

        if (! enum_exists($enumClass)) {
            throw new \Exception("Enum class $enumClass does not exist");
        }

        $this->widthOptionsEnum = $enumClass;

        return $this;
    }

    public function getWidthOptionsEnum(): string|null
    {
        return $this->widthOptionsEnum;
    }

    public function buttonClasses(array $buttonClasses): self
    {
        $this->buttonClasses = $buttonClasses;

        return $this;
    }

    public function getButtonClasses(): array
    {
        return $this->buttonClasses;
    }

    public function trackingActions(array $trackingActions): self
    {
        $this->trackingActions = $trackingActions;

        return $this;
    }

    public function getTrackingActions(): array
    {
        return $this->trackingActions;
    }
}
