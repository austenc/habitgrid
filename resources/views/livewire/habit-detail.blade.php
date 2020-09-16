<div>
    <x-slot name="title">{{ $habit->name }}</x-slot>
    <x-slot name="titleActions">
        <a href="{{ route('habits.index') }}" class="text-link">Back to all habits</a>
    </x-slot>
    <div x-data="{ editing: false }" class="mb-2">
        <div class="flex justify-between mt-4 pb-1">
            <div>
                <x-streak-badge :habit="$habit" />
            </div>
            <div class="">
                <div class="mt-4 md:mt-0 flex items-center flex-row-reverse md:flex-row justify-between md:flex-1">
                    <button @click.prevent="editing = !editing" type="button" x-text="editing ? 'Cancel' : 'Edit'" class="block text-sm p-1 uppercase font-semibold tracking-wide text-link">Edit</button>
                </div>
            </div>
        </div>
        <div x-show="editing" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
        >
            <livewire:habit-form :habit="$habit" />
        </div>
    </div>

    <livewire:day-grid :habit="$habit" /> 
</div>
