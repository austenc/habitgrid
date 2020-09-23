<div>
    <div class="flex space-x-2 items-center">
        <button wire:click="previous" class="text-gray-500 hover:text-gray-700">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
        </button>
        <div class="flex flex-grow space-x-3">
            @foreach ($daysInWeek as $day)
                <x-day-card 
                    wire:click="selectDay('{{ $day }}')" 
                    :unit="Str::plural($habit->unit ?? '', $totals->get($day->toImmutable()->format('Y-m-d')) ?? 0)" 
                    :selected="$day->toDateTimeString() == $current" 
                    :total="$totals->get($day->toImmutable()->format('Y-m-d')) ?? 0" 
                    :date="$day" 
                />
            @endforeach
        </div>
        <button wire:click="next" class="text-gray-500 hover:text-gray-700">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
</div>
