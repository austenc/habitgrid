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
    <body class="font-sans antialiased text-gray-600 bg-gray-100">
        @includeIf('nav')
        <div class="container">
            @yield('content')
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
