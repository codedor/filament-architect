<?php

namespace Codedor\FilamentArchitect\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Codedor\FilamentArchitect\ArchitectConfig fromConfig()
 * @method static \Codedor\FilamentArchitect\ArchitectConfig widthOptionsEnum(string|null $enumClass)
 * @method static string|null getWidthOptionsEnum()
 * @method static \Codedor\FilamentArchitect\ArchitectConfig buttonClasses(array $buttonClasses)
 * @method static array getButtonClasses()
 * @method static \Codedor\FilamentArchitect\ArchitectConfig trackingActions(array $trackingActions)
 * @method static array getTrackingActions()
 *
 * @see \Codedor\FilamentArchitect\ArchitectConfig
 */
class ArchitectConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Codedor\FilamentArchitect\ArchitectConfig::class;
    }
}
