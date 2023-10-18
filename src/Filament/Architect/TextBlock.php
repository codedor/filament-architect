<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\HtmlString;
use Illuminate\View\View;

class TextBlock extends BaseBlock
{
    protected ?string $name = 'Text columns block';

    public function render(array $data): ?View
    {
        return view('filament-architect::architect.text-block', [
            'data' => $data,
            'columns' => $data['columns'] ?? 1,
            'textColumns' => collect()->pad($data['columns'] ?? 1, null)->keys()->map(
                fn ($key) => new HtmlString($data['text'][$key] ?? '')
            )->filter(),
        ]);
    }

    public function schema(): array
    {
        return [
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
        ];
    }
}
