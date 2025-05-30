<?php

namespace Codedor\FilamentArchitect\Filament\Components;

use Codedor\FilamentArchitect\Facades\ArchitectConfig;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TrackingComponent
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return \Filament\Schemas\Components\Section::make('Tracking information')
            ->statePath('tracking')
            ->collapsed()
            ->columns(2)
            ->schema([
                TextInput::make('category'),

                Select::make('action')
                    ->options(ArchitectConfig::getTrackingActions()),

                TextInput::make('label'),

                Checkbox::make('non_interaction'),
            ]);
    }
}
