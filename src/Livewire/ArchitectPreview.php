<?php

namespace Wotz\FilamentArchitect\Livewire;

use Livewire\Component;

class ArchitectPreview extends Component
{
    public string $cacheKey;

    public function mount(
        string $cacheKey
    ) {
        $this->cacheKey = $cacheKey;
    }

    public function render()
    {
        $blocks = cache()->get("architect-preview-{$this->cacheKey}");

        abort_if(! $blocks, 404);

        return view('filament-architect::livewire.architect-preview', [
            'blocks' => $blocks,
        ]);
    }
}
