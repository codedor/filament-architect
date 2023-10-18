<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\Filament\Components\ButtonComponent;
use Filament\Forms\Components\TextInput;
use Illuminate\View\View;

class CtaBlock extends BaseBlock
{
    protected ?string $name = 'CTA Block';

    public function render(array $data): ?View
    {
        return view('filament-architect::architect.cta-block', [
            'title' => $data['title'] ?? '',
            'button' => $data['button'] ?? null,
        ]);
    }

    public function schema(): array
    {
        return [
            TextInput::make('title')
                ->required(),

            ButtonComponent::make('button'),
        ];
    }
}
