<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Awcodes\DropInAction\Forms\Components\DropInAction;
use Closure;
use Codedor\FilamentArchitect\Filament\Components\ButtonComponent;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;

class CtaBlock extends BaseBlock
{
    public function schema(): array
    {
        return [
            TextInput::make('title'),
            ButtonComponent::make('button'),
        ];
    }
}
