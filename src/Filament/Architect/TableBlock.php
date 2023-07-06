<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use FilamentTiptapEditor\TiptapEditor;

class TableBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            TiptapEditor::make('table')
                ->disableBubbleMenus(false),
        ];
    }
}
