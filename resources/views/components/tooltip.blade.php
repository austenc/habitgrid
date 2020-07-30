@props(['title'])

<span x-data="{ open: false }" {{ $attributes->merge(['class' => 'text-left cursor-pointer whitespace-no-wrap']) }}>
    <span class="inline-block w-full relative">
        <span x-cloak x-show="open" class="absolute top-0 transform -translate-y-full -mt-1 inline-block bg-gray-900 text-gray-100 py-px px-2 text-xs rounded">
            {{ $title }}
        </span>
        <span @mouseover="open = true" @mouseout="open = false">
            {{ $slot }}
        </span>
    </span>
</span>