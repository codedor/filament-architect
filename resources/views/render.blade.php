@foreach ($blocks as $blockRow)
    @foreach ($blockRow as $block)
        {{ $block }}
    @endforeach
@endforeach
