<?php

use Codedor\FilamentArchitect\BlockCollection;
use Codedor\FilamentArchitect\Filament\BuilderBlocks;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

it('can fill collection from original config', function () {
    $collection = (new BlockCollection())->fromConfig();

    expect($collection)
        ->count()->toBe(11)
        ->toArray()->sequence(
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\ButtonBlock::class);
                $key->toBe('ButtonBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\CardBlock::class);
                $key->toBe('CardBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\CtaBlock::class);
                $key->toBe('CtaBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\MediaBlock::class);
                $key->toBe('MediaBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\MediaTextBlock::class);
                $key->toBe('MediaTextBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\SliderBlock::class);
                $key->toBe('SliderBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\SpacerBlock::class);
                $key->toBe('SpacerBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\TableBlock::class);
                $key->toBe('TableBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\TextBlock::class);
                $key->toBe('TextBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\VideoBlock::class);
                $key->toBe('VideoBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(BuilderBlocks\VideoTextBlock::class);
                $key->toBe('VideoTextBlock');
            }
        );
});

it('can return the filament blocks', function () {
    $collection = new BlockCollection();

    $collection->put('SpacerBlock', new BuilderBlocks\SpacerBlock());

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

    $collection->put('SpacerBlock', new BuilderBlocks\SpacerBlock());

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
