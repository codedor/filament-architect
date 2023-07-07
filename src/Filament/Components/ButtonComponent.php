<?php

namespace Codedor\FilamentArchitect\Filament\Components;

use Awcodes\DropInAction\Forms\Components\DropInAction;
use Closure;
use Codedor\LinkPicker\Forms\Components\LinkPickerInput;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ButtonComponent
{
    public static function make(string $statePath)
    {
        return Grid::make()
            ->schema([
                DropInAction::make('button')
                    ->disableLabel()
                    ->execute(function (Closure $get, Closure $set) use ($statePath) {
                        $currentText = $get("{$statePath}.text");
                        return Action::make($statePath)
                            ->icon('heroicon-o-pencil-alt')
                            ->label($currentText ? "Edit {$currentText}" : 'Add button')
                            ->mountUsing(fn (ComponentContainer $form) => $form->fill($get($statePath)))
                            ->form([
                                TextInput::make('text'),
                                Select::make('type')
                                    ->options([
                                        'primary-button' => 'Primary button',
                                        'text-button' => 'Text button',
                                    ]),
                                LinkPickerInput::make('link'),
                                TextInput::make('title'),
                                Fieldset::make('Tracking')
                                    ->schema([
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
                                    ])
                                    ->statePath('tracking')
                            ])
                            ->action(function ($data) use ($set, $statePath) {
                                $set($statePath, $data);
                            });
                    }),
                Hidden::make($statePath),
            ]);
    }
}
