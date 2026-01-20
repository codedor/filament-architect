<?php

return [
    'default-blocks' => [
        \Wotz\FilamentArchitect\Filament\Architect\ButtonBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\CardBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\CtaBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\EmbedBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\MediaBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\MediaTextBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\SliderBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\SpacerBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\TableBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\TextBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\VideoBlock::class,
        \Wotz\FilamentArchitect\Filament\Architect\VideoTextBlock::class,
    ],
    'enableDuplicateButton' => false,
    'enableShownButton' => false,
    'widthOptions' => \Wotz\FilamentArchitect\Enums\WidthOptions::class,
    'buttonClasses' => [
        'btn btn-primary' => 'Primary button',
        'btn btn-link' => 'Text',
    ],
    'trackingActions' => ['hit', 'play', 'pause', 'download', 'view', 'open', 'close'],
    'attachmentFormats' => [
        \Wotz\MediaLibrary\Formats\Thumbnail::class,
    ],
    'enable-slug-in-block' => false,
];
