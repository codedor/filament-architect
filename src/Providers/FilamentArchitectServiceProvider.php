<?php

namespace Codedor\FilamentArchitect\Providers;

use Codedor\FilamentArchitect\ArchitectConfig;
use Codedor\FilamentArchitect\BlockCollection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentArchitectServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-architect')
            ->setBasePath(__DIR__ . '/../')
            ->hasConfigFile()
            ->hasMigration('create_package_table')
            ->hasTranslations()
            ->hasViews();
    }

    public function registeringPackage(): void
    {
        $this->app->bind(BlockCollection::class, function () {
            return (new BlockCollection())->fromConfig();
        });

        $this->app->bind(ArchitectConfig::class, function () {
            return (new ArchitectConfig())->fromConfig();
        });
    }
}
