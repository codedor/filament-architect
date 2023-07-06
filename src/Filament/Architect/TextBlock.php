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
        return [
            Tabs::make('text')
                ->tabs([
                    Tab::make('Settings')
                        ->schema([
                            TextInput::make('columns')
                                ->numeric()
                                ->reactive()
                                ->afterStateUpdated(function ($component, Closure $get, Closure $set) {
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
                                }),
                            Checkbox::make('separate_editors')
                                ->label('Use Separate Text Editors')
                                ->reactive()
                                ->afterStateUpdated(function ($component, Closure $get, Closure $set) {
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
                                }),
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
//                            $fields = [
//                                TiptapEditor::make('text.0')
//                                    ->label('')
//                                    ->default('')
//                                    ->reactive(),
//                            ];
//
//                            if ($get('separate_editors')) {
//                                for ($i = 1; $i < $get('columns'); $i++) {
//                                    $fields[] = TiptapEditor::make("text.{$i}")
//                                        ->default('')
//                                        ->label('')
//                                        ->reactive();
//                                }
//                            }
//
//                            return $fields;
//                        })
//                        ->reactive(),
                ]),
        ];
    }
}
