<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\ArchitectFormats;
use Codedor\FilamentArchitect\Facades\ArchitectConfig;
use Codedor\MediaLibrary\Filament\AttachmentInput;
use Codedor\MediaLibrary\Models\Attachment;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
use Illuminate\View\View;

class MediaBlock extends BaseBlock
{
    public function render(array $data): ?View
    {
        return view('filament-architect::architect.media-block', [
            'width' => $data['width'] ?? null,
            'images' => collect($data['images'] ?? [])->map(function (array $image) {
                return Attachment::find($image['image'] ?? null);
            })->filter(),
        ]);
    }

    public function schema(): array
    {
        return [
            Radio::make('width')
                ->visible((bool) ArchitectConfig::getWidthOptionsEnum())
                ->required()
                ->options(function (Get $get) {
                    $enum = ArchitectConfig::getWidthOptionsEnum();

                    if (! $enum) {
                        return [];
                    }

                    if (is_array($get('images')) && count($get('images')) > 2) {
                        return $enum::toSelectForMaxImages();
                    }

                    return $enum::toSelect();
                }),

            Repeater::make('images')
                ->schema([
                    AttachmentInput::make('image')
                        ->allowedFormats(ArchitectFormats::get()),
                ])
                ->minItems(1)
                ->maxItems(3)
                ->reactive()
                ->grid(3),
        ];
    }
}
