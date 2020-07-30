<div>
    <x-card>
        <div class="flex space-x-2">
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
    </x-card>
    <div class="mt-3">
        Current Day: <span class="italic">{{ $selected ?? 'None' }}</span>
    </div>
    @foreach ($this->habits as $habit)
        <x-card class="mt-3">
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