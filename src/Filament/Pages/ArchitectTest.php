<?php

namespace Codedor\FilamentArchitect\Filament\Pages;

use Codedor\FilamentArchitect\Filament\Fields\ArchitectInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Str;

/**
 * @property Form $form
 */
class ArchitectTest extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Architect';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-architect::filament.architect-test';

    public ?array $data = [];

    public static function shouldRegisterNavigation(): bool
    {
        return app()->environment('local');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                ArchitectInput::make('body')
                    ->required()
                    ->afterStateHydrated(static function (ArchitectInput $component, ?array $state): void {
                        $items = [];

                        foreach (config('filament-architect.default-blocks', []) as $name => $itemData) {
                            $newUuid = (string) Str::uuid();

                            $items[$newUuid] = [
                                'type' => $name,
                                'data' => [],
                            ];

                            $component->state($items);
                            $component->getChildComponentContainers()[$newUuid]->fill();
                        }
                    }),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }
}
