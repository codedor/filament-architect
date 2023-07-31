<?php

namespace Codedor\FilamentArchitect\Filament\Components;

use Codedor\FilamentArchitect\Facades\ArchitectConfig;
use Codedor\LinkPicker\Filament\LinkPickerInput;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Fieldset;
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
                Action::make('add-button')
                    ->label(function (Get $get) use ($statePath) {
                        $currentText = $get("{$statePath}.text");
                        return $currentText ? "Edit {$currentText}" : 'Add button';
                    })
                    ->icon('heroicon-o-pencil')
                    ->fillForm(fn (Get $get) => $get($statePath))
                    ->form([
                        TextInput::make('text'),
                        Select::make('type')
                            ->options(ArchitectConfig::getButtonClasses()),
                        LinkPickerInput::make('link'),
                        TextInput::make('title'),
                        Fieldset::make('Tracking')
                            ->schema([
                                TextInput::make('category'),
                                Select::make('action')
                                    ->options(ArchitectConfig::getTrackingActions()),
                                TextInput::make('label'),
                                Checkbox::make('non_interaction'),
                            ])
                            ->statePath('tracking'),
                    ])
                    ->action(function ($data, Set $set) use ($statePath) {
                        $set($statePath, $data);
                    })
            ]);
    }
}
