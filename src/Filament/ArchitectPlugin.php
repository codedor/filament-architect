<?php

namespace Codedor\FilamentArchitect\Filament;

use Codedor\FilamentArchitect\Filament\Pages\ArchitectTest;
use Codedor\FilamentMenu\Filament\Pages\MenuBuilder;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;

class ArchitectPlugin implements Plugin
{
    private bool $hasArchitectTestPage = true;

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
}

