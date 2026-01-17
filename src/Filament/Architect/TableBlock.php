<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Filament\Forms\Components\RichEditor;
use Illuminate\View\View;

class TableBlock extends BaseBlock
{
    public function render(array $data): ?View
    {
        return view('filament-architect::architect.table-block', [
            'table' => $data['table'] ?? '',
        ]);
    }

    public function schema(): array
    {
        return [
            RichEditor::make('table')
                ->required(),
        ];
    }
}
