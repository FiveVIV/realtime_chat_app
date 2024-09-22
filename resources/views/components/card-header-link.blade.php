@props(["active", "ping" => false])

@php

    $classes = ($active ?? false)
                ? "whitespace-nowrap relative border-b-2 border-indigo-500 px-1 pb-4 text-sm font-medium text-indigo-600"
                : "whitespace-nowrap relative border-b-2 border-transparent px-1 pb-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"

@endphp



<a {{ $attributes->merge(["class" => $classes]) }}>
    {{ $slot }}
    @if ($ping)
        <span class="animate-ping absolute -right-2 -top-2.5 block size-4 rounded-full bg-[#ff0000]"></span>
        <span class="absolute -right-2 -top-2.5 block size-4 rounded-full bg-[#ff0000]"></span>
    @endif
</a>
