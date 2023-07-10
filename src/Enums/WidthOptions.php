<?php

namespace Codedor\FilamentArchitect\Enums;

enum WidthOptions: string implements WidthOptionsInterface
{
    case FullWidth = 'full_width';
    case Container = 'container';
    case TextContainer = 'text_container';

    public function description(): string
    {
        return match($this)
        {
            self::FullWidth => __('filament-architect::width-options.full width'),
            self::Container => __('filament-architect::width-options.container'),
            self::TextContainer => __('filament-architect::width-options.text container'),
        };
    }

    public static function toSelect(): array
    {
        return [
            self::FullWidth->value => self::FullWidth->description(),
            self::Container->value => self::Container->description(),
            self::TextContainer->value => self::TextContainer->description(),
        ];
    }

    public static function toSelectForMaxImages(): array
    {
        return [
            self::FullWidth->value => self::FullWidth->description(),
            self::Container->value => self::Container->description(),
        ];
    }
}
