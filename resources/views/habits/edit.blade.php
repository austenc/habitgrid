@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="mt-6 border border-teal-200 rounded p-6 bg-teal-100 text-teal-700">
            {{ session('message') }}
        </div>
    @endif
    <div class="mx-auto mt-12">
        <div x-data="{ editing: false }">
            <div class="flex items-baseline justify-between">
                <div class="flex space-x-3 items-center">
                    <h1 class="text-3xl font-semibold">{{ $habit->name }}</h1>
                    <div class="inline-flex items-center py-px px-3 bg-orange-200 text-orange-700 rounded-full">113 day streak!</div>
                    <button @click.prevent="editing = !editing" type="button" x-text="editing ? 'Cancel' : 'Edit'" class="text-sm p-1 uppercase font-semibold tracking-wide text-link">Edit</button>
                </div>
                <a href="{{ route('habits.index') }}" class="text-link">Back to all habits</a>
            </div>
            <div x-show="editing" x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
            >
                <x-habit-form :habit="$habit" :action="route('habits.update', $habit)" method="PUT" />
            </div>
        </div>

        <div class="mt-6">
        	<livewire:day-grid /> 
        </div>

        <div class="my-10">
            <h2 class="text-gray-400 font-semibold text-xl text-center">Recent Entries</h2>
        </div>
        <div class="flex space-x-3">
            <x-day-card :unit="$habit->unit" :total="2" :date="today()->subDay()">
                <x-slot name="badge">
                    <div class="inline-flex whitespace-no-wrap text-xs items-center py-px px-3 bg-primary-100 text-primary-600 rounded-full">50% above avg</div>
                </x-slot>
            </x-day-card>
            <x-day-card :unit="$habit->unit" :total="1" :date="today()" />
            <x-day-card :unit="$habit->unit" :total="45" :date="today()->addDay()">
                <x-slot name="badge">
                    <div class="inline-flex whitespace-no-wrap text-xs items-center py-px px-3 bg-green-100 text-green-600 rounded-full">500% above avg</div>
                </x-slot>
            </x-day-card>
            <x-day-card :unit="$habit->unit" :total="0.5" :date="today()->addDay(2)" />
            <x-day-card :unit="$habit->unit" :total="3" :date="today()->addDay(3)" />
        </div>
    </div>
@endsection