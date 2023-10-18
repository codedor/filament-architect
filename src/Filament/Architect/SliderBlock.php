<?php

namespace Codedor\FilamentArchitect\Filament\Architect;

use Codedor\FilamentArchitect\ArchitectFormats;
use Codedor\MediaLibrary\Filament\AttachmentInput;
use Codedor\MediaLibrary\Models\Attachment;
use Filament\Forms\Components\Repeater;
use Illuminate\View\View;

class SliderBlock extends BaseBlock
{
    public function render(array $data): ?View
    {
        $images = collect($data['slider'] ?? [])->pluck('image')->filter();

        return view('filament-architect::architect.slider-block', [
            'images' => Attachment::find($images)->filter(),
        ]);
    }

    public function schema(): array
    {
        return [
            Repeater::make('slider')
                ->schema([
                    AttachmentInput::make('image')
                        ->allowedFormats(ArchitectFormats::get()),
                ])
                ->minItems(1)
                ->grid(3),
        ];
    }
}
