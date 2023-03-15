<?php

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