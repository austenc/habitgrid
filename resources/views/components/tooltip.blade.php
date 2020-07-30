<span x-data="{ open: false }">
    <span class="inline-block w-full relative">
        <span x-show="open" class="absolute top-0 -mt-5 transform inline-block bg-gray-900 text-gray-100 py-px px-2 text-sm rounded">
            {{ $title }}
        </span>
    </span>
    <span @mouseover="open = true" @mouseout="open = false">
        {{ $slot }}
    </span>
</span>