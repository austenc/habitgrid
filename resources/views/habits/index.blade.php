@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-12">
        <div class="flex items-baseline justify-between">
            <h1 class="text-3xl font-semibold">Habits</h1>
            <a href="/" class="text-primary-500 hover:text-primary-700">Back to dashboard</a>
        </div>

        <x-habit-form />

        <div class="space-y-2 mt-8">
            <h2 class="text-gray-400 font-semibold text-xl text-center">Currently Tracking</h2>
            @foreach ($habits as $habit)
                <x-card>
                    <div class="flex justify-between items-center">
                        <div class="text-lg font-medium">
                            {{ $habit->name }}
    
                            <div class="flex mt-2 space-x-12 text-gray-500">
                                <div class="">
                                    <div class="uppercase text-sm text-gray-400 tracking-wide">Daily Goal</div>
                                    {{ $habit->goal ?? 'N/A' }}
                                </div>
                                <div class="">
                                    <div class="uppercase text-sm text-gray-400 tracking-wide">Unit</div>
                                    {{ $habit->unit ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('habits.edit', $habit) }}" class="block mr-4 uppercase text-base font-medium text-primary-500 hover:text-primary-700">Details</a>
                    </x-card>
                </div>
            @endforeach
        </div>
    </div>
@endsection