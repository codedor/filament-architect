<?php

namespace Codedor\FilamentArchitect\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \self fromConfig()
 * @method static \self widthOptionsEnum(string|null $enumClass)
 * @method static string|null getWidthOptionsEnum()
 * @method static \self buttonClasses(array $buttonClasses)
 * @method static array getButtonClasses()
 * @method static \self trackingActions(array $trackingActions)
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
