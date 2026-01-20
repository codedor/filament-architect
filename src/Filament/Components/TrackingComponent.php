<?php

namespace Wotz\FilamentArchitect\Filament\Components;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Wotz\FilamentArchitect\Facades\ArchitectConfig;

class TrackingComponent
{
    public static function make(): \Filament\Schemas\Components\Component
    {
        return \Filament\Schemas\Components\Section::make(__('filament-architect::admin.tracking information'))
            ->statePath('tracking')
            ->collapsed()
            ->columns(2)
            ->schema([
                TextInput::make('category')
                    ->label(__('filament-architect::admin.category')),

                Select::make('action')
                    ->label(__('filament-architect::admin.action'))
                    ->options(ArchitectConfig::getTrackingActions()),

                TextInput::make('label')
                    ->label(__('filament-architect::admin.label')),

                Checkbox::make('non_interaction')
                    ->label(__('filament-architect::admin.non interaction')),
            ]);
    }
}
