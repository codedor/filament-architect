<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\TranslatableTabs\Forms\TranslatableTabs;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;

class TextBlock extends BaseBlock
{
    protected ?string $name = 'Text block';

    public function schema(): array
    {
        return [
            TranslatableTabs::make('text')
                ->defaultFields([
                    TextInput::make('columns')
                        ->numeric()
                        ->reactive()
                        ->minValue(1)
                        ->maxValue(3)
                        ->extraInputAttributes(['min' => 1, 'max' => 3]),
                ])
                ->translatableFields(fn () => [
                    TiptapEditor::make('text')
                        ->label('')
                        ->default(''),
                ]),
        ];
    }
}
