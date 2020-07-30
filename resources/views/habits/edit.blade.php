@extends('layouts.app')

@section('content')
    <div class="mx-auto mt-12">
        <div class="flex items-baseline justify-between">
            <div class="flex space-x-3 items-center">
                <h1 class="text-3xl font-semibold">{{ $habit->name }}</h1>
                <div class="inline-flex items-center py-px px-3 bg-orange-200 text-orange-700 rounded-full">113 day streak!</div>
            </div>
            <a href="{{ route('habits.index') }}" class="text-primary-500 hover:text-primary-700">Back to all habits</a>
        </div>

        <x-card>
           <livewire:day-grid /> 
        </x-card>

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