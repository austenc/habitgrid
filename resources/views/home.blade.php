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


    <div class="flex space-x-2 pb-20 mt-20 px-10">
        <div class="space-y-1.5">
            <div class="leading-4">&nbsp;</div>
            @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                <div class="text-xs leading-4 text-gray-500">
                    {!! $loop->even ? $dayName : '&nbsp;' !!}
                </div>
            @endforeach
        </div>

        <div class="">
            <div class="w-full flex space-x-1.5 text-xs text-gray-500">
                @foreach ($weeks as $week)
                    <div class="w-4 h-4">
                        @if ($week->format('d') <= 7)
                            {{ $week->format('M') }}
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="flex space-x-1.5 leading-4 mt-1">
                @foreach (array_chunk($days->toArray(), 7) as $week)
                    <div class="space-y-1.5">
                        @foreach ($week as $day)
                            <div class="bg-gray-400 w-4 h-4 rounded">
                                <span class="sr-only">{{ $day->format('Y-m-d') }}</span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
