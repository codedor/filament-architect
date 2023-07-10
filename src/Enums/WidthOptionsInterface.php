<?php

namespace Codedor\FilamentArchitect\Enums;

interface WidthOptionsInterface
{
    public static function toSelect(): array;

    public static function toSelectForMaxImages(): array;
}
