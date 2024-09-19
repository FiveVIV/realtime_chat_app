@props([
    "colorTheme" => "white"
])


@php
    $colorThemeClasses = match ($colorTheme) {
        default => 'text-gray-700 bg-white hover:bg-gray-200',
        'slate' => 'text-gray-300 bg-slate-950 hover:bg-slate-800'
    }

@endphp



<button class="text-left flex items-center px-4 py-2 text-sm w-full {{ $colorThemeClasses }}" role="menuitem" tabindex="-1" {{ $attributes }}>
    {{ $icon }}
    {{ $slot }}
</button>
