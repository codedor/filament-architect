<div class="content-padding">
    <div class="container">
        <div class="row">
            @foreach ($textColumns as $text)
                <div @class([
                    'wysiwyg col-lg-' . 12 / $columns,
                  ])>
                    {!! $text !!}
                </div>
            @endforeach
        </div>
    </div>
</div>
