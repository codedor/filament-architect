<?php

use Codedor\FilamentArchitect\Architect;

beforeEach(function () {
    $this->data = [
        [
            'type' => 'SpacerBlock',
            'data' => [
                'height' => 32,
            ],
        ],
    ];
});

it('can make the class', function () {
    expect(Architect::make($this->data))
        ->toBeInstanceOf(Architect::class);
});

it('cannot make the class if data is a string', function () {
    expect(Architect::make('data'))
        ->toBeString()
        ->toBe('data');
});

it('can return html', function () {
    expect(new Architect($this->data))
        ->toHtml()->toBeString();
});

it('can return an array', function () {
    expect(new Architect($this->data))
        ->toArray()->toBe($this->data);
});
