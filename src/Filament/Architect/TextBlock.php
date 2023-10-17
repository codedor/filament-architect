<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\TranslatableTabs\Forms\TranslatableTabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\View\View;

class TextBlock extends BaseBlock
{
    protected ?string $name = 'Text block';

    public function render(array $data, array $translations): ?View
    {
        return view('filament-architect::architect.text-block', [
            'data' => $data,
            'translations' => $translations,
        ]);
    }

    public function schema(): array
    {
        return [
            TranslatableTabs::make('text')
                ->locales($this->getLocales())
                ->persistInQueryString(false)
                ->defaultFields([])
                ->translatableFields(fn () => [
                    TextInput::make('columns')
                        ->numeric()
                        ->reactive()
                        ->minValue(1)
                        ->maxValue(3)
                        ->extraInputAttributes(['min' => 1, 'max' => 3]),

                    Grid::make(1)->schema(function (Get $get) {
                        return collect()
                            ->pad($get('columns') ?? 1, null)
                            ->keys()
                            ->map(function (string $key) {
                                return TiptapEditor::make("text.{$key}")
                                    ->label('Text');
                            })
                            ->toArray();
                    }),

                    Toggle::make('online'),
                ]),
        ];
    }
}
