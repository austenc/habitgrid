@props(['title', 'open'])

<span x-data="{ open: {{ $open ?? 'false' }} }" {{ $attributes->merge(['class' => 'text-left cursor-pointer whitespace-no-wrap']) }}>
    <span class="inline-block w-full relative">
        <span x-cloak x-show="open" class="-mt-1 p-3 absolute top-0 transform -translate-y-full -translate-x-1/2 ml-1/2 inline-block bg-gray-800 text-gray-200 text-xs rounded">
            <span class="font-bold">{{ $title }}</span>
            @if ($label ?? false)
                <span class="mt-3 block uppercase tracking-wide text-gray-500 text-xs">{{ $label }}</span>
            @endif
            @if ($body ?? false)
                <span class="block mt-1 pt-2 border-t border-gray-600">
                    {{ $body }}
                </span>
            @endif
        </span>
        <span @mouseover="open = true" @mouseout="open = false">
            {{ $slot }}
        </span>
    </span>
</span>