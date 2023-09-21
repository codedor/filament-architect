<?php

namespace Codedor\FilamentArchitect\Filament;

use Codedor\FilamentArchitect\Filament\Pages\ArchitectTest;
use Codedor\FilamentArchitect\Filament\Resources\ArchitectTemplateResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class ArchitectPlugin implements Plugin
{
    private bool $hasArchitectTestPage = true;

    private bool $architectTemplateResource = true;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-architect';
    }

    public function register(Panel $panel): void
    {
        if ($this->hasArchitectTestPage()) {
            $panel->pages([
                ArchitectTest::class,
            ]);
        }

        if ($this->hasArchitectTemplateResource()) {
            $panel->resources([
                ArchitectTemplateResource::class,
            ]);
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function architectTestPage(bool $condition = true): static
    {
        $this->hasArchitectTestPage = $condition;

        return $this;
    }

    public function hasArchitectTestPage(): bool
    {
        return $this->hasArchitectTestPage;
    }

    public function architectTemplateResource(bool $condition = true): static
    {
        $this->architectTemplateResource = $condition;

        return $this;
    }

    public function hasArchitectTemplateResource(): bool
    {
        return $this->architectTemplateResource;
    }
}
