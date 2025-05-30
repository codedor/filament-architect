<?php

namespace Codedor\FilamentArchitect\Livewire;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Livewire\Component;

class EditModal extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public string $statePath;

    public array $state;

    public array $arguments;

    public function mount(array $arguments)
    {
        $this->arguments = $arguments;
        $this->state = $arguments['block']['data'] ?? [];
        $this->form->fill($this->state);
    }

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Group::make()
                ->statePath('state')
                ->schema([
                    TextInput::make('working_title')
                        ->helperText('This is purely to help you identify the block in the list of blocks.')
                        ->required(config('filament-architect.enable-slug-in-block'))
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state, \Filament\Schemas\Components\Utilities\Get $get) => $get('slug') || $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->hidden(! config('filament-architect.enable-slug-in-block'))
                        ->helperText('This slug will be used to make anchor links. Modifying this field will break existing anchor links to this block'),

                    ...$this->arguments['blockClassName']::make()
                        ->locales($this->arguments['locales'])
                        ->schema(),
                ]),
        ]);
    }

    public function validates()
    {
        return $this->form->validate();
    }

    public function getFormData()
    {
        return $this->form->getState();
    }

    public function render()
    {
        return view('filament-architect::livewire.edit-modal');
    }

    public function isCachingForms(): bool
    {
        return false;
    }
}
