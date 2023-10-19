<?php

use Codedor\FilamentArchitect\Enums\WidthOptions;
use Codedor\FilamentArchitect\Facades\ArchitectConfig;

it('can fill from config', function () {
    config()->set([
        'filament-architect.widthOptions' => WidthOptions::class,
        'filament-architect.buttonClasses' => [
            'primary' => 'Primary',
            'secondary' => 'Secondary',
        ],
        'filament-architect.trackingActions' => [
            'hit',
            'play',
        ],
    ]);

    ArchitectConfig::fromConfig();

    expect(ArchitectConfig::getWidthOptionsEnum())->toBe(WidthOptions::class);

    expect(ArchitectConfig::getButtonClasses())->toBe([
        'primary' => 'Primary',
        'secondary' => 'Secondary',
    ]);

    expect(ArchitectConfig::getTrackingActions())->toBe([
        'hit',
        'play',
    ]);
});

it('can set empty enum', function () {
    $architectConfig = new \Codedor\FilamentArchitect\ArchitectConfig();

    $architectConfig->widthOptionsEnum(null);

    expect($architectConfig->getWidthOptionsEnum())->toBeNull();
});

it('throws error if enum does not exist', function () {
    $architectConfig = new \Codedor\FilamentArchitect\ArchitectConfig();

    $architectConfig->widthOptionsEnum(\Codedor\FilamentArchitect\ArchitectConfig::class);

    expect($architectConfig->getWidthOptionsEnum())->toBeNull();
})->throws(Exception::class);

it('can set preview action', function () {
    $architectConfig = new \Codedor\FilamentArchitect\ArchitectConfig();

    $architectConfig->previewAction(fn () => 'preview');

    expect($architectConfig->getPreviewAction()())->toBe('preview');
});
