<div class="mt-6 flex items-center justify-between">
    <div class="w-1/5">
        @if ($this->carbonDay->greaterThan($days->first()))
            <button wire:click="previous" class="text-2xl lg:text-sm whitespace-no-wrap text-primary-200 hover:text-white xl:text-primary-500 xl:hover:text-primary-700 py-1 px-3">
                &laquo; <span class="hidden lg:inline">Previous</span>
            </button>
        @endif
    </div>
    <div class="w-3/5 text-center text-base xl:text-xl font-medium text-white xl:text-gray-600">
        {{ $this->carbonDay->format('l F jS, Y') }}
    </div>
    <div class="w-1/5 text-right">
        @if ($this->carbonDay->lessThan(today()))
            <button wire:click="next" class="text-2xl lg:text-sm whitespace-no-wrap text-primary-200 hover:text-white xl:text-primary-500 xl:hover:text-primary-700 py-1 px-3">
                <span class="hidden lg:inline">Next</span> &raquo;
            </button>
        @endif
    </div>
</div>
@foreach ($this->habits as $habit)
    <x-card class="mt-2">
        <div class="flex justify-between items-center">
            <span class="font-medium">{{ $habit->name }}</span>
            <div class="text-right space-x-2">
                @if ($this->habits->count() > 1)
                    <a href="{{ route('habits.edit', $habit) }}" class="mr-4 text-link font-medium uppercase text-sm">Details</a>
                @endif

                @if ($habit->tracks->isEmpty())
                    <button wire:click="addTrack({{ $habit->id }})" type="button" class="px-4 py-2 rounded text-white bg-gray-500 hover:bg-gray-700 transition-all duration-300">
                        Mark as Complete
                    </button>
                @else 
                    <div class="text-left flex items-end space-x-2" x-data>
                        <x-input name="amount" :value="$habit->tracks->first()->amount" x-on:input.debounce="$wire.updateAmount({{ $habit->id }}, $event.target.value)" :label="ucwords(Str::plural($habit->unit ?? '', $habit->goal))" :placeholder="$habit->goal . ' ' . Str::plural($habit->unit ?? '', $habit->goal)" />
                        <button wire:click="removeTrack({{ $habit->id }})" type="button" class="h-10 mt-px px-4 py-2 text-sm rounded text-white bg-primary-500 hover:bg-primary-700 transition-all duration-300">
                            Completed
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </x-card>
@endforeach