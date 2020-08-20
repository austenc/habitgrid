@props([
    'action' => '',
    'method' => 'POST'
])

<form {{ $attributes }} action="{{ $action }}" method="{{ $method == 'GET' ? 'GET' : 'POST' }}">
    @unless ($method == 'GET')
        @csrf
        @method($method)
    @endunless
    {{ $slot }}
</form>