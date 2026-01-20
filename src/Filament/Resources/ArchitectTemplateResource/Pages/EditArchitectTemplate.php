<?php

namespace Wotz\FilamentArchitect\Filament\Resources\ArchitectTemplateResource\Pages;

use Wotz\FilamentArchitect\Filament\Resources\ArchitectTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArchitectTemplate extends EditRecord
{
    protected static string $resource = ArchitectTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
