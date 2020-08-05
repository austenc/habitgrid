<div class="relative">
    <div wire:loading class="absolute z-10 top-0 left-0 w-full h-full rounded border-red-400 bg-white bg-opacity-75">
        <div class="flex w-full h-full items-center justify-center">
            <x-icon-loader class="w-10 h-10 text-primary-600" />
        </div>
    </div>
    <x-card>
        
        {{-- Horizontal --}}
        <div class="hidden xl:flex space-x-2 justify-center">
            <div class="space-y-1.5">
                <div class="leading-4">&nbsp;</div>
                @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                    <div class="text-xs leading-4 text-gray-500">
                        {!! $loop->even ? $dayName : '&nbsp;' !!}
                    </div>
                @endforeach
            </div>
        
            <div class="">
                <div class="w-full flex space-x-1 text-xs text-gray-500">
                    @foreach ($weeks as $week)
                        <div class="w-4 h-4">
                            @if ($week->format('d') <= 7)
                                {{ $week->format('M') }}
                            @endif
                        </div>
                    @endforeach
                </div>
        
                <div class="flex space-x-1 leading-4 mt-1">
                    @foreach (array_chunk($days->toArray(), 7) as $week)
                        <div class="space-y-1.5">
                            @foreach ($week as $day)
                                <span wire:click="toggleDay('{{ $day }}')" 
                                    class="{{ $this->classForDay($day) }} block w-4 h-4 rounded border-2 border-transparent"
                                >
                                    <x-tooltip :title="$day->format('M d, Y')">
                                        <span class="inline-block w-full h-full">
                                            <span class="sr-only">{{ $day->format('Y-m-d') }}</span>
                                        </span>
                                    </x-tooltip>
                                </span>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Mobile size, by month --}}
        <div class="xl:hidden">
            @foreach ($daysByMonth as $daysInMonth)
                <div class="flex space-x-2 mt-1">
                    <div class="w-8 text-xs leading-4 text-gray-500">
                        {{ $daysInMonth->first()->format('M') }}
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap leading-4" x-data>
                            @foreach ($daysInMonth as $day)
                                <span wire:click="toggleDay('{{ $day }}')" 
                                    @click.prevent="document.body.classList.toggle('fixed'); document.body.classList.toggle('xl:static')"
                                    class="{{ $this->classForDay($day) }} block mr-2 mb-2 w-6 h-6 rounded border-2 border-transparent"
                                >
                                    <x-tooltip :title="$day->format('D M d, Y')">
                                        <span class="inline-block w-full h-full">
                                            <span class="sr-only">{{ $day->format('Y-m-d') }}</span>
                                        </span>
                                    </x-tooltip>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Legend --}}
        <div class="flex items-center justify-center xl:justify-end xl:mr-2 space-x-1 mt-4">
            <div class="px-px text-gray-500 text-xs">Less</div>
            @foreach (range(0, 4) as $number)
                <div class="{{ $this->colorByNumber($number) }} block w-4 h-4 rounded border-2 border-transparent">
                    &nbsp;
                </div>
            @endforeach
            <div class="px-px text-gray-500 text-xs">More</div>
        </div>

        @if ($habit ?? false)
            <div class="mt-8">
                <livewire:week-view :habit="$habit" :current-day="$selected" /> 
            </div>
        @endif
    </x-card>
    @if ($selected)

        {{-- Desktop version --}}
        <div class="hidden xl:block">
            @include('tracks.edit')
        </div>

        {{-- Mobile version --}}
        <div class="xl:hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-75 p-8" x-data>
            <div class="relative mt-20"
                @click.away="window.livewire.emit('dayUnselected')" 
                @keydown.escape.window="window.livewire.emit('dayUnselected')" 
            >
                @include('tracks.edit')
            </div>
        </div>
    @endif
</div>