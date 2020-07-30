<form action="{{ route('habits.store') }}" method="POST">
    @csrf
    <x-card>
        <label class="block text-sm font-medium">
            Habit Name
            <input type="text" name="name" placeholder="Habit name" class="form-input block w-full">
        </label>
        <div class="mt-3 flex space-x-3">
            <label class="flex-1 block text-sm font-medium">
                Daily Goal
                <input type="text" name="goal" placeholder="Daily goal" class="w-full form-input block">
            </label>
            <label class="flex-1 block text-sm font-medium">
                Unit of Measurement
                <input type="text" name="unit" placeholder="Hours, number of times, gallons, etc..." class="w-full form-input block">
            </label>
        </div>
        <div class="mt-3 text-right">
            <button type="submit" class="px-3 py-2 text-white rounded bg-primary-700 hover:bg-primary-500">Create Habit</button>
        </div>
    </x-card>
</form>
