<?php

namespace Wotz\FilamentArchitect\Enums;

interface WidthOptionsInterface
{
    public static function toSelect(): array;

    public static function toSelectForMaxImages(): array;
}
