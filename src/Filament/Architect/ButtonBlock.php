<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\Filament\Components\ButtonComponent;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Illuminate\View\View;

class ButtonBlock extends BaseBlock
{
    protected ?string $name = 'Button block';

    public function render(array $data): ?View
    {
        return view('filament-architect::architect.button-block', [
            'buttons' => collect($data['buttons'])->pluck('button'),
            'alignment' => $data['alignment'] ?? 'left',
        ]);
    }

    public function schema(): array
    {
        return [
            Radio::make('alignment')
                ->required()
                ->options([
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right',
                ])
                ->inline()
                ->inlineLabel(false)
                ->default('left')
                ->formatStateUsing(fn (mixed $state) => $state ?? 'left'),

            Repeater::make('buttons')
                ->schema([ButtonComponent::make('button')])
                ->minItems(1)
                ->maxItems(3)
                ->grid(3),
        ];
    }
}
