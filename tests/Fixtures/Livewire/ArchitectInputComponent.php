<?php

namespace Wotz\FilamentArchitect\Tests\Fixtures\Livewire;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\View\View;
use Livewire\Component;
use Wotz\FilamentArchitect\Filament\Fields\PageArchitectInput;

class ArchitectInputComponent extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                PageArchitectInput::make('body'),
            ])
            ->statePath('data');
    }

    public function render(): View
    {
        return view('fixtures.architect-input-component');
    }
}
