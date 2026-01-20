<?php

use Wotz\FilamentArchitect\Filament\Architect\BaseBlock;
use Wotz\FilamentArchitect\Filament\Architect\ButtonBlock;
use Wotz\FilamentArchitect\Filament\Fields\PageArchitectInput;
use Wotz\FilamentArchitect\Tests\Fixtures\Blocks\TestBlock;
use Filament\Forms\Components\Builder\Block;

beforeEach(function () {
    config(['filament-architect.default-blocks' => [TestBlock::class]]);
    $this->field = PageArchitectInput::make('body');
});

it('can create the field with default blocks', function () {
    expect($this->field)
        ->getBlocks()->toHaveCount(1)->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(BaseBlock::class)
                ->getName()->toBe('Test Block')
        );
});

it('can exclude blocks', function () {
    $this->field->excludedBlocks([TestBlock::make()]);

    expect($this->field)
        ->getBlocks()->toHaveCount(0);
});

it('can add extra blocks', function () {
    $this->field->extraBlocks([ButtonBlock::make()]);

    expect($this->field)
        ->getBlocks()->toHaveCount(2)
        ->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(BaseBlock::class)
                ->getName()->toBe('Button block'),
            fn ($block) => $block
                ->toBeInstanceOf(BaseBlock::class)
                ->getName()->toBe('Test Block'),
        );
});

it('can chain add and exclude blocks methods', function () {
    $this->field->extraBlocks([ButtonBlock::make()]);
    $this->field->excludedBlocks([TestBlock::make()]);

    expect($this->field)
        ->getBlocks()->toHaveCount(1)
        ->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(BaseBlock::class)
                ->getName()->toBe('Button block')
        );
});

it('can overwrite default blocks', function () {
    $this->field->blocks([ButtonBlock::make()]);

    expect($this->field)
        ->getBlocks()->toHaveCount(1)->sequence(
            fn ($block) => $block
                ->toBeInstanceOf(BaseBlock::class)
                ->getName()->toBe('Button block')
        );
});
