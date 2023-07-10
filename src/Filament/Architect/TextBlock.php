<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Closure;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Str;

class TextBlock extends BaseBlock
{
    public function schema(): array
    {
        $closure = function ($component, Closure $get, Closure $set) {
            $editors = $get('editors');

            if ($get('separate_editors')) {
                if (count($editors) < $get('columns')) {
                    for ($i = count($editors); $i < $get('columns'); $i++) {
                        $editors[(string) Str::uuid()] = [];
                    }
                } elseif (count($editors) > $get('columns')) {
                    $editors = array_slice($editors, 0, $get('columns'));
                }

                $set('editors', $editors);
            }
        };
        
        return [
            Tabs::make('text')
                ->tabs([
                    Tab::make('Settings')
                        ->schema([
                            TextInput::make('columns')
                                ->numeric()
                                ->reactive()
                                ->maxValue(10)
                                ->afterStateUpdated($closure),
                            Checkbox::make('separate_editors')
                                ->label('Use Separate Text Editors')
                                ->reactive()
                                ->afterStateUpdated($closure),
                            Radio::make('width')
                                ->options([
                                    'full-width' => 'Full Width',
                                    'container' => 'Container',
                                    'text-container' => 'Text Container',
                                ]),
                        ]),
                    Tab::make('General')
                        ->schema([
                            Repeater::make('editors')
                                ->schema([
                                    TiptapEditor::make('text')
                                        ->label('')
                                        ->default(''),
                                ])
                                ->disableItemCreation()
                                ->disableItemDeletion()
                                ->disableItemMovement()
                                ->defaultItems(1),
                        ]),
                ]),
        ];
    }
}
