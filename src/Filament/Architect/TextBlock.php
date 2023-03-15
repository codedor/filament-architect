<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Closure;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;

class TextBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('text')
                ->tabs([
                    Tabs\Tab::make('Settings')
                        ->schema([
                            TextInput::make('columns')
                                ->numeric()
                                ->reactive(),
                            Checkbox::make('separate_editors')
                                ->label('Use Separate Text Editors')
                                ->reactive(),
                            Radio::make('width')
                                ->options([
                                    'container' => 'Container',
                                    'text-container' => 'Text Container',
                                ]),
                            Checkbox::make('intro_text'),
                        ]),
                    Tabs\Tab::make('General')
                        ->schema(function (Closure $get) {
                            $fields = [MarkdownEditor::make('text.0')];

                            if ($get('separate_editors')) {
                                for ($i = 1; $i < $get('columns'); $i++) {
                                    $fields[] = MarkdownEditor::make("text.{$i}");
                                }
                            }

                            return $fields;
                        })
                        ->reactive(),
                ]),
        ];
    }
}
