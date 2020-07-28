@extends('layouts.app')

@section('content')
    {{-- <div class="text-4xl">
        <h1 class="mt-40 text-6xl text-center font-semibold text-gray-500">
            Booster
        </h1>
    
        <div class="mt-20 flex justify-around">
            <a class="text-primary-500 hover:text-primary-700" href="https://tailwindcss.com">Tailwind CSS</a>
            <a class="text-primary-500 hover:text-primary-700" href="https://github.com/alpinejs/alpine">Alpine JS</a>
            <a class="text-primary-500 hover:text-primary-700" href="https://laravel.com/docs">Laravel</a>
            <a class="text-primary-500 hover:text-primary-700" href="https://laravel-livewire.com/docs">Livewire</a>
        </div>
    </div> --}}

    <a href="{{ route('habits.index') }}" class="text-primary-500 hover:text-primary-700">Manage Habits</a>

    {{-- Day Grid --}}
    <x-day-grid />
@endsection
