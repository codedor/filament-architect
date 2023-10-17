@props([
    'columns' => $translations['columns'] ?? 1,
])

<ul>
    @for ($i = 0; $i < $columns; $i++)
        <li>
            {!! $translations['text'][$i] ?? null !!}
        </li>
    @endfor
</ul>
