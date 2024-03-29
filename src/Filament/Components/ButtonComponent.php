<?php

namespace Codedor\FilamentArchitect\Filament\Components;

use Codedor\FilamentArchitect\Facades\ArchitectConfig;
use Codedor\LinkPicker\Filament\LinkPickerInput;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Get;
use Filament\Forms\Set;

class ButtonComponent
{
    public static function make(string $statePath): Component
    {
        return ViewField::make($statePath)
            ->view('filament-architect::components.button-field')
            ->registerActions([
                Action::make('addButton')
                    ->label(function (Get $get) use ($statePath) {
                        $currentText = $get("{$statePath}.text");

                        return $currentText ? $currentText : 'Button';
                    })
                    ->icon(function (Get $get) use ($statePath) {
                        $currentText = $get("{$statePath}.text");

                        return $currentText ? 'heroicon-o-pencil' : 'heroicon-o-plus';
                    })
                    ->fillForm(fn (Get $get) => $get($statePath))
                    ->form([
                        TextInput::make('text')
                            ->label('Text on the button')
                            ->required(),

                        Select::make('type')
                            ->options(ArchitectConfig::getButtonClasses())
                            ->required(),

                        LinkPickerInput::make('link')
                            ->required(),

                        TextInput::make('title')
                            ->helperText('Optional, will be displayed when hovering over the button'),

                        TrackingComponent::make(),
                    ])
                    ->action(function ($data, Set $set) use ($statePath) {
                        $set($statePath, $data);
                    }),
                Action::make('removeButton')
                    ->color('danger')
                    ->label(__('Remove button'))
                    ->icon('heroicon-o-trash')
                    ->action(fn ($data, Set $set) => $set($statePath, [])),
            ]);
    }
}
