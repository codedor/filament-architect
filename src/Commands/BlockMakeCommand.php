<?php

namespace Wotz\FilamentArchitect\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:architect-block')]
class BlockMakeCommand extends GeneratorCommand
{
    protected $name = 'make:architect-block';

    protected $description = 'Create a new architect block';

    protected $type = 'Block';

    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return (bool) Command::SUCCESS;
        }

        $this->writeView();

        return (bool) Command::SUCCESS;
    }

    /**
     * Write the view for the block.
     */
    protected function writeView(): void
    {
        $path = $this->viewPath(
            str_replace('.', '/', 'architect.' . $this->getView()) . '.blade.php'
        );

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        if ($this->files->exists($path) && ! $this->option('force')) {
            $this->components->error('View already exists.');

            return;
        }

        file_put_contents(
            $path,
            '<div>
</div>'
        );
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        return (string) Str::of(parent::buildClass($name))
            ->replace('{{ viewName }}', 'architect.' . $this->getView())
            ->replace('{{ blockName }}', Str::headline(str_replace($this->getNamespace($name).'\\', '', $name)));
    }

    /**
     * Get the view name relative to the architect directory.
     *
     * @return string view
     */
    protected function getView()
    {
        $name = str_replace('\\', '/', $this->argument('name'));

        return collect(explode('/', $name))
            ->map(function ($part) {
                return Str::kebab($part);
            })
            ->implode('.');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/architect-block.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Architect';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the block already exists'],
        ];
    }
}
