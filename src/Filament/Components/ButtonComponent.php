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
    public static function make(string $statePath): \Filament\Schemas\Components\Component
    {
        return ViewField::make($statePath)
            ->view('filament-architect::components.button-field')
            ->registerActions([
                \Filament\Actions\Action::make('addButton')
                    ->label(function (\Filament\Schemas\Components\Utilities\Get $get) use ($statePath) {
                        $currentText = $get("{$statePath}.text");

                        return $currentText ? $currentText : __('filament-architect::admin.button');
                    })
                    ->icon(function (\Filament\Schemas\Components\Utilities\Get $get) use ($statePath) {
                        $currentText = $get("{$statePath}.text");

                        return $currentText ? 'heroicon-o-pencil' : 'heroicon-o-plus';
                    })
                    ->fillForm(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get($statePath))
                    ->schema([
                        TextInput::make('text')
                            ->label(__('filament-architect::admin.text on button'))
                            ->required(),

                        Select::make('type')
                            ->label(__('filament-architect::admin.type'))
                            ->options(ArchitectConfig::getButtonClasses())
                            ->required(),

                        LinkPickerInput::make('link')
                            ->label(__('filament-architect::admin.link'))
                            ->required(),

                        TextInput::make('title')
                            ->label(__('filament-architect::admin.title'))
                            ->helperText(__('filament-architect::admin.title help')),

                        TrackingComponent::make(),
                    ])
                    ->action(function ($data, \Filament\Schemas\Components\Utilities\Set $set) use ($statePath) {
                        $set($statePath, $data);
                    }),
                \Filament\Actions\Action::make('removeButton')
                    ->color('danger')
                    ->label(__('filament-architect::admin.remove button'))
                    ->icon('heroicon-o-trash')
                    ->action(fn ($data, \Filament\Schemas\Components\Utilities\Set $set) => $set($statePath, [])),
            ]);
    }
}
