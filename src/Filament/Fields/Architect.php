<?php

namespace Codedor\FilamentArchitect\Filament\Fields;

use Codedor\FilamentArchitect\Models\ArchitectTemplate;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;

class Architect
{
    public static function make(string $statePath)
    {
        return Group::make()
            ->schema([
                Placeholder::make($statePath),
                Actions::make([
                    Action::make('template')
                        ->label('Add from template')
                        ->form(fn () => [
                            Select::make('template')
                                ->hiddenLabel()
                                ->options(fn () => ArchitectTemplate::pluck('name', 'id'))
                                ->required(),
                        ])
                        ->action(function (array $data, Set $set) use ($statePath): void {
                            $template = ArchitectTemplate::find($data['template']);
                            $set($statePath, $template->body);
                        }),
                ])->hidden(fn (Get $get) => ! blank($get($statePath))),
                ArchitectInput::make($statePath)
                    ->hiddenLabel(),
            ]);
    }
}
