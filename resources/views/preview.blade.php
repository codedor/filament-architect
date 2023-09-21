<x-app-layout titleForLayout="Preview Architect">
    {!! \Codedor\FilamentArchitect\Architect::make($blocks->toArray())->toHtml()  !!}
</x-app-layout>
