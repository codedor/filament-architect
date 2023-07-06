<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Closure;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;

class TextBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('text')
                ->tabs([
                    Tab::make('Settings')
                        ->schema([
                            TextInput::make('columns')
                                ->numeric()
                                ->reactive()
                                ->afterStateUpdated(function ($component, Closure $get) {
                                    $component->getContainer()->getParentComponent()->getContainer()->getParentComponent()->getChildComponentContainer()->getComponents()[1]->fillStateWithNull();
                                }),
                            Checkbox::make('separate_editors')
                                ->label('Use Separate Text Editors')
                                ->reactive(),
                            Radio::make('width')
                                ->options([
                                    'full-width' => 'Full Width',
                                    'container' => 'Container',
                                    'text-container' => 'Text Container',
                                ]),
                        ]),
                    Tab::make('General')
                        ->schema(function (Closure $get) {
                            $fields = [
                                TiptapEditor::make('text.0')
                                    ->label('')
                                    ->default('')
                                    ->reactive(),
                            ];

                            if ($get('separate_editors')) {
                                for ($i = 1; $i < $get('columns'); $i++) {
                                    $fields[] = TiptapEditor::make("text.{$i}")
                                        ->default('')
                                        ->label('')
                                        ->reactive();
                                }
                            }

                            return $fields;
                        })
                        ->reactive(),
                ]),
        ];
    }
}
