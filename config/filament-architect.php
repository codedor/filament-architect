<?php

return [
    'default-blocks' => [
        \Codedor\FilamentArchitect\Filament\Architect\ButtonBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\CardBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\CtaBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\EmbedBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\MediaBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\MediaTextBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\SliderBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\SpacerBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\TableBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\TextBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\VideoBlock::class,
        \Codedor\FilamentArchitect\Filament\Architect\VideoTextBlock::class,
    ],
    'widthOptions' => \Codedor\FilamentArchitect\Enums\WidthOptions::class,
    'buttonClasses' => [
        'btn btn-primary' => 'Primary button',
        'btn btn-link' => 'Text',
    ],
    'trackingActions' => ['hit', 'play', 'pause', 'download', 'view', 'open', 'close'],
    'attachmentFormats' => [
        \Codedor\MediaLibrary\Formats\Thumbnail::class,
    ],
];
