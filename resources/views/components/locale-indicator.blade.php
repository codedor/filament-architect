@props([
    'online',
    'locale',
    'color' => $online ? 'success' : 'danger',
])

<a style="--c-500:var(--{{ $color }}-500);--c-700:var(--{{ $color }}-700);" class="
    text-custom-700 bg-custom-500/10 dark:text-custom-500
    rtl:space-x-reverse min-h-6 px-2 py-0.5 text-xs font-medium tracking-tight
    inline-flex items-center justify-center space-x-1
    rounded-xl whitespace-nowrap
">
    {{ $locale }}
</a>
