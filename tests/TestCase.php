<?php

namespace Codedor\FilamentArchitect\Tests;

use Codedor\FilamentArchitect\Providers\FilamentArchitectServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Codedor\\FilamentArchitect\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $app['config']->set('view.paths', [
            __DIR__ . '/views',
            __DIR__ . '/../resources/views',
        ]);
        /*
        $migration = include __DIR__.'/../database/migrations/create_filament-architect_table.php.stub';
        $migration->up();
        */
    }

    protected function getPackageProviders($app)
    {
        return [
            FilamentArchitectServiceProvider::class,
        ];
    }
}
