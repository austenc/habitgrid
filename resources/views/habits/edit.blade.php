@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="mt-6 border border-teal-200 rounded p-6 bg-teal-100 text-teal-700">
            {{ session('message') }}
        </div>
    @endif
    
    
    <div class="mx-auto mt-12">
        <livewire:habit-detail :habit="$habit" />

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