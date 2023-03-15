<?php

use Codedor\FilamentArchitect\BlockCollection;
use Codedor\FilamentArchitect\Facades\BlockCollection as FacadesBlockCollection;
use Codedor\FilamentArchitect\Filament\Architect;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

it('can fill collection from original config', function () {
    $collection = FacadesBlockCollection::all();

    expect($collection)
        ->toHaveCount(11)
        ->sequence(
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\ButtonBlock::class);
                $key->toBe('ButtonBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\CardBlock::class);
                $key->toBe('CardBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\CtaBlock::class);
                $key->toBe('CtaBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\MediaBlock::class);
                $key->toBe('MediaBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\MediaTextBlock::class);
                $key->toBe('MediaTextBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\SliderBlock::class);
                $key->toBe('SliderBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\SpacerBlock::class);
                $key->toBe('SpacerBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\TableBlock::class);
                $key->toBe('TableBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\TextBlock::class);
                $key->toBe('TextBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\VideoBlock::class);
                $key->toBe('VideoBlock');
            },
            function ($block, $key) {
                $block->toBeInstanceOf(Architect\VideoTextBlock::class);
                $key->toBe('VideoTextBlock');
            }
        );
});

it('can return the filament blocks', function () {
    $collection = new BlockCollection();

    $collection->put('SpacerBlock', new Architect\SpacerBlock());

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

    $collection->put('SpacerBlock', new Architect\SpacerBlock());

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
