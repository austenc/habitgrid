@extends('layouts.app')

@section('content')
    <div class="pt-12">
        <div x-data="{ open: false }">
            <div class="flex items-baseline justify-between mb-3">
                <h1 class="text-3xl font-semibold">Habits</h1>
                <button @click.prevent="open = !open" type="button" x-text="open ? 'Hide Form' : 'Add New Habit'" class="block text-sm p-1 uppercase font-semibold tracking-wide text-link"></button>
            </div>
    
            <div x-show="open" x-cloak class="mb-5"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
            >
                <x-habit-form />
            </div>
        </div>

        <livewire:day-grid />

        <div class="space-y-2 mt-8">
            <h2 class="text-gray-400 font-semibold text-xl text-center">Currently Tracking</h2>
            @foreach ($habits as $habit)
                <x-card>
                    <div class="flex justify-between items-center">
                        <div class="text-lg font-medium">
                            <div class="flex items-center space-x-3">
                                <div>
                                    {{ $habit->name }}
                                </div>
                                <x-streak-badge :habit="$habit" />
                            </div>
    
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