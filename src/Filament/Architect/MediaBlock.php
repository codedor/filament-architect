<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\Facades\ArchitectConfig;
use Codedor\MediaLibrary\Filament\AttachmentInput;
use Codedor\MediaLibrary\Models\Attachment;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Get;

class MediaBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            Tabs::make('buttons')
                ->tabs([
                    Tab::make('Settings')
                        ->schema([
                            Radio::make('width')
                                ->visible((bool) ArchitectConfig::getWidthOptionsEnum())
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
                        ]),
                    Tab::make('General')
                        ->schema([
                            Repeater::make('images')
                                ->schema([
                                    AttachmentInput::make('image'),
                                ])
                                ->minItems(1)
                                ->maxItems(3)
                                ->reactive()
                                ->grid(3),
                        ]),
                ]),
        ];
    }

    public function getData(): array
    {
        $this->data['data']['images'] = collect($this->data['data']['images'])->map(function ($image) {
            return Attachment::find($image['image']);
        });

        return $this->data;
    }
}
