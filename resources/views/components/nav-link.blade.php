@props(['url', 'class'])

<a 
    href="{{ $url }}" 
    class="
        {{ $class ?? 'px-3 ml-6 h-full inline-flex items-center text-sm font-semibold border-b-4 text-gray-300 hover:text-white' }}
        {{ Str::startsWith(Request::url(), $url) ? 'border-primary-500' : 'border-transparent hover:border-gray-700' }}
    "
    {{ $attributes->filter(fn ($value, $key) => $key != 'class') }}
>
    {{ $slot }}
</a>