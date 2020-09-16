<div class="py-8">
    <x-slot name="title">Habits</x-slot>
    <x-slot name="titleActions">
        <button x-data="{ open: false }" @click.prevent="open = !open; @this.set('showForm', open)" type="button" x-text="open ? 'Hide Form' : 'Add New Habit'" class="inline-block text-sm p-1 uppercase font-semibold tracking-wide text-link">Add New Habit</button>
    </x-slot>
    <div x-data="{ open: @entangle('showForm') }">
        @if ($habits->isEmpty())
            <x-card x-show.transition="!open">You don't have any habits yet, <button @click.prevent="open = true" type="button" class="text-link">create one</button> to get started.</x-card>
        @endif

        <div x-show.transition.duration.400="open" x-cloak class="mb-5">
            <x-habit-form />
        </div>
    </div>

    <div class="space-y-2">
        @foreach ($habits as $habit)
            <x-card>
                <div class="flex justify-between items-center">
                    <div class="text-lg font-medium">
                        <div class="flex items-center space-x-3">
                            <div>
                                {{ $habit->name }}
                            </div>
                            <x-streak-badge :habit="$habit" />
                        </div>

                        <div class="flex mt-2 space-x-12 text-gray-500">
                            <div class="">
                                <div class="uppercase text-sm text-gray-400 tracking-wide">Daily Goal</div>
                                {{ $habit->goal ?? 'N/A' }}
                            </div>
                            <div class="">
                                <div class="uppercase text-sm text-gray-400 tracking-wide">Unit</div>
                                {{ $habit->unit ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('habits.edit', $habit) }}" class="block mr-4 uppercase text-base font-medium text-primary-500 hover:text-primary-700">Details</a>
                </x-card>
            </div>
        @endforeach
    </div>
</div>
