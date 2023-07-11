<?php

use Codedor\FilamentArchitect\Filament\Architect\ButtonBlock;
use Codedor\FilamentArchitect\Filament\Fields\Architect;
use Codedor\FilamentArchitect\Tests\Fixtures\Blocks\TestBlock;
use Filament\Forms\Components\Builder\Block;

beforeEach(function () {
    config(['filament-architect.default-blocks' => [TestBlock::class]]);
    $this->field = Architect::make('body');
});

it('can create the field with default blocks', function () {
    expect($this->field)
        ->getChildComponents()->toHaveCount(1)->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(Block::class)
                ->getName()->toBe('TestBlock')
        );
});

it('can exclude blocks', function () {
    $this->field->excludeBlocks([TestBlock::class]);

    expect($this->field)
        ->getChildComponents()->toHaveCount(0);
});

it('can add extra blocks', function () {
    $this->field->addBlocks([ButtonBlock::class]);

    expect($this->field)
        ->getChildComponents()->toHaveCount(2)
        ->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(Block::class)
                ->getName()->toBe('TestBlock'),
            fn ($block) => $block
                ->toBeInstanceOf(Block::class)
                ->getName()->toBe('ButtonBlock')
        );
});

it('can chain add and exclude blocks methods', function () {
    $this->field->addBlocks([ButtonBlock::class]);
    $this->field->excludeBlocks([TestBlock::class]);

    expect($this->field)
        ->getChildComponents()->toHaveCount(1)
        ->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(Block::class)
                ->getName()->toBe('ButtonBlock')
        );
});

it('can overwrite default blocks', function () {
    $this->field->blocks([ButtonBlock::make()->toFilament()]);

    expect($this->field)
        ->getChildComponents()->toHaveCount(1)->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(Block::class)
                ->getName()->toBe('ButtonBlock')
        );
});
