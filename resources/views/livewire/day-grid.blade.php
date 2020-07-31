<div>
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
                        <div class="flex flex-wrap leading-4">
                            @foreach ($daysInMonth as $day)
                                <span wire:click="toggleDay('{{ $day }}')" 
                                    class="{{ $this->classForDay($day) }} block mr-1 mb-1 w-4 h-4 rounded border-2 border-transparent"
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
    </x-card>
    @if ($selected)
        <div class="mt-6 flex justify-between">
            <div>
                @if ($this->carbonDay->greaterThan($days->first()))
                    <button wire:click="previous" class="text-link py-1 px-3">&laquo; Previous</button>
                @endif
            </div>
            <div class="text-center text-xl font-medium">
                {{ $this->carbonDay->format('l F jS, Y') }}
            </div>
            <div>
                @if ($this->carbonDay->lessThan(today()))
                    <button wire:click="next" class="text-link py-1 px-3">Next &raquo;</button>
                @endif
            </div>
        </div>
    @endif
    @foreach ($this->habits as $habit)
        <x-card class="mt-2">
            <div class="flex justify-between items-center">
                Habit: {{ $habit->name }}
                <div class="text-right space-x-2">
                    @if ($habit->tracks->isEmpty())
                        <button wire:click="addTrack({{ $habit->id }})" type="button" class="px-4 py-2 rounded text-white bg-gray-500 hover:bg-gray-700 transition-all duration-300">
                            Incomplete
                        </button>
                    @else 
                        <button wire:click="removeTrack({{ $habit->id }})" type="button" class="px-4 py-2 rounded text-white bg-primary-500 hover:bg-primary-700 transition-all duration-300">
                            Completed
                        </button>
                    @endif
                </div>
            </div>
        </x-card>
    @endforeach
</div>