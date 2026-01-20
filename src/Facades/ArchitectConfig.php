<?php

namespace Wotz\FilamentArchitect\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Wotz\FilamentArchitect\ArchitectConfig fromConfig()
 * @method static \Wotz\FilamentArchitect\ArchitectConfig widthOptionsEnum(string|null $enumClass)
 * @method static string|null getWidthOptionsEnum()
 * @method static \Wotz\FilamentArchitect\ArchitectConfig buttonClasses(array $buttonClasses)
 * @method static array getButtonClasses()
 * @method static \Wotz\FilamentArchitect\ArchitectConfig trackingActions(array $trackingActions)
 * @method static array getTrackingActions()
 *
 * @see \Wotz\FilamentArchitect\ArchitectConfig
 */
class ArchitectConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Wotz\FilamentArchitect\ArchitectConfig::class;
    }
}
