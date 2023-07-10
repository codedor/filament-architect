<?php

use Codedor\FilamentArchitect\BlockCollection;
use Codedor\FilamentArchitect\Facades\BlockCollection as FacadesBlockCollection;
use Codedor\FilamentArchitect\Filament\Architect\ButtonBlock;
use Codedor\FilamentArchitect\Filament\Architect\CardBlock;
use Codedor\FilamentArchitect\Filament\Architect\CtaBlock;
use Codedor\FilamentArchitect\Filament\Architect\EmbedBlock;
use Codedor\FilamentArchitect\Filament\Architect\MediaBlock;
use Codedor\FilamentArchitect\Filament\Architect\MediaTextBlock;
use Codedor\FilamentArchitect\Filament\Architect\SliderBlock;
use Codedor\FilamentArchitect\Filament\Architect\SpacerBlock;
use Codedor\FilamentArchitect\Filament\Architect\TableBlock;
use Codedor\FilamentArchitect\Filament\Architect\TextBlock;
use Codedor\FilamentArchitect\Filament\Architect\VideoBlock;
use Codedor\FilamentArchitect\Filament\Architect\VideoTextBlock;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

it('can fill collection from original config', function () {
    $collection = FacadesBlockCollection::all();

    expect($collection)
        ->toHaveCount(12)
        ->sequence(
            function ($block, $key) {
                $block->toBeInstanceOf(ButtonBlock::class);
                $key->toBe('ButtonBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(CardBlock::class);
                $key->toBe('CardBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(CtaBlock::class);
                $key->toBe('CtaBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(EmbedBlock::class);
                $key->toBe('EmbedBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(MediaBlock::class);
                $key->toBe('MediaBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(MediaTextBlock::class);
                $key->toBe('MediaTextBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(SliderBlock::class);
                $key->toBe('SliderBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(SpacerBlock::class);
                $key->toBe('SpacerBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(TableBlock::class);
                $key->toBe('TableBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(TextBlock::class);
                $key->toBe('TextBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(VideoBlock::class);
                $key->toBe('VideoBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(VideoTextBlock::class);
                $key->toBe('VideoTextBlock');
            }
        );
});

it('can return the filament blocks', function () {
    $collection = new BlockCollection();

    $collection->put('SpacerBlock', new SpacerBlock());

    $blocks = $collection->filamentBlocks();

    expect($blocks)
        ->toHaveKey('SpacerBlock')
        ->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(Block::class)
                ->getName()->toBe('SpacerBlock')
                ->getChildComponents()
                ->toHaveCount(1)
                ->sequence(fn ($field) => $field
                    ->toBeInstanceOf(TextInput::class)
                    ->getName()->toBe('height')
                )
        );
});

it('can render the blocks', function () {
    $collection = new BlockCollection();

    $collection->put('SpacerBlock', new SpacerBlock());

    $blockData = [
        'type' => 'SpacerBlock',
        'data' => [
            'height' => 32,
        ],
    ];
    $view = $collection->render([$blockData]);

    expect($view)
        ->getName()->toBe('filament-architect::overview')
        ->getData()->sequence(fn ($blockViews) => $blockViews
        ->sequence(fn ($blockView) => $blockView
            ->getName()->toBe('filament-architect::architect.spacer-block')
            ->getData()->sequence(function ($viewData, $key) use ($blockData) {
                $key->toBe('data');
                $viewData->toBe($blockData);
            })
        )
        );
});
