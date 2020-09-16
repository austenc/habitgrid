<div>
    <x-card>
        <form wire:submit.prevent="save">
            <x-input name="habit.name" wire:model="habit.name" label="Habit Name" placeholder="Habit Name" />
    
            <div class="mt-3 flex space-x-3">
                <div class="flex-1">
                    <x-input name="habit.goal" wire:model="habit.goal" label="Daily Goal" placeholder="Daily Goal" />
                </div>
                <div class="flex-1">
                    <x-input name="habit.unit" wire:model="habit.unit" label="Unit of Measurement" placeholder="Unit of Measurement" />
                </div>
            </div>
            <div class="mt-3 text-right">
                <button class="px-3 py-2 text-white rounded bg-primary-700 hover:bg-primary-500">
                    @if ($habit ?? false)
                        Update Habit
                    @else
                        Create Habit
                    @endif
                </button>
            </div>
        </form>
    </x-card>
</div>
