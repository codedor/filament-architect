<?php

namespace Codedor\FilamentArchitect\Filament\BuilderBlocks;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;

class CtaBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('cta')
                ->tabs([
                    Tabs\Tab::make('Settings')
                        ->schema([
                            Select::make('variant')
                                ->options([
                                    'white' => 'White',
                                    'gray' => 'Gray',
                                    'primary' => 'Primary',
                                ]),
                        ]),
                    Tabs\Tab::make('General')
                        ->schema([
                            MarkdownEditor::make('title'),
                            MarkdownEditor::make('description'),
                            TextInput::make('text'),
                            Select::make('type')
                                ->options([
                                    'filled' => 'Filled button',
                                    'filled-arrow' => 'Filled arrow button',
                                    'outline' => 'Outline button',
                                    'outline-arrow' => 'Outline arrow button',
                                    'ghost' => 'Ghost button',
                                ]),
                            TextInput::make('url')
                                ->url(),
                            TextInput::make('category'),
                            Select::make('action')
                                ->options([
                                    'hit' => 'Hit',
                                    'play' => 'Play',
                                    'pause' => 'Pause',
                                    'download' => 'Download',
                                    'view' => 'View',
                                    'open' => 'Open',
                                    'close' => 'Close',
                                ]),
                            TextInput::make('label'),
                            Checkbox::make('non_interaction'),
                        ]),
                ]),
        ];
    }
}
