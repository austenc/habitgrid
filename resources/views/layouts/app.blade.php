<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles
    </head>
    <body class="font-sans antialiased text-gray-600 bg-gray-200">
        @includeIf('nav')
        @isset($title)
            <div class="bg-gray-300 py-3">
                <div class="container flex items-center justify-between">
                    <h1 class="text-xl lg:text-2xl font-bold tracking-tight text-gray-500">
                        {{ $title ?? null }}
                    </h1>
                    {{ $titleActions ?? null }}
                </div>
            </div>
        @endisset
        <div class="container">
            {{-- TODO: convert HabitController to component and get rid of it --}}
            @empty($slot)
                @yield('content')            
            @else
                {{ $slot }}
            @endempty
        </div>
        @livewireScripts
        <script src="{{ mix('js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>
