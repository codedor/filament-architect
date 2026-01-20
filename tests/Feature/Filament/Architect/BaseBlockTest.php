<?php

use Wotz\FilamentArchitect\Tests\Fixtures\Blocks\TestBlock;
use Illuminate\View\View;

beforeEach(function () {
    $this->block = new TestBlock();
});

it('has a default name', function () {
    expect($this->block)
        ->getName()->toBe('Test Block');
});

it('can render', function () {
    expect($this->block)
        ->render([])->toBeNull();
});
