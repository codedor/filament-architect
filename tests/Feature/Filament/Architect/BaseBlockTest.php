<?php

use Codedor\FilamentArchitect\Tests\Fixtures\Blocks\TestBlock;
use Illuminate\View\View;

beforeEach(function () {
    $this->block = new TestBlock();
});

it('has a default name', function () {
    expect($this->block)
        ->getName()->toBe('TestBlock');
});

it('can set a name', function () {
    $this->block->name('CustomName');

    expect($this->block)
        ->getName()->toBe('CustomName');
});

it('has a view name', function () {
    $this->block->name('TestBlock');

    expect($this->block)
        ->getViewName()->toBe('architect.test-block');
});

it('can set data', function () {
    $this->block->data(['key' => 'value']);

    expect($this->block)
        ->getData()->toBe(['key' => 'value']);
});

it('can render', function () {
    expect($this->block)
        ->render()->toBeInstanceOf(View::class);
});

it('can render a custom view', function () {
    $this->block->view('architect.test-custom-block');
    expect($this->block)
        ->render()->toBeInstanceOf(View::class);
});
