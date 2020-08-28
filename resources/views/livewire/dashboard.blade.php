<div class="py-12">
    <div class="flex items-baseline justify-between mb-3">
        <h1 class="text-3xl font-semibold">Dashboard</h1>
    </div>

    <div class="space-y-3 sm:flex sm:space-x-5 sm:space-y-0">
        <x-card class="flex-1">
            <div class="uppercase text-center border-primary-500 text-xs tracking-wide text-gray-500">
                Best Current Streak
            </div>
            <div class="text-center mt-1">
                @if (($habitWithBestStreak->currentStreak->length ?? 0) > 0)
                    <div class="font-semibold text-center pb-2">
                        <a href="{{ route('habits.edit', $habitWithBestStreak) }}">
                            {{ $habitWithBestStreak->name }}
                        </a>
                    </div>
                    <x-streak-badge :habit="$habitWithBestStreak" />
                @else
                    <div class="mt-2 text-center text-4xl font-bold">0</div>
                @endif
            </div>
        </x-card>
        <x-card class="flex-1">
            <div class="uppercase text-center border-primary-500 text-xs tracking-wide text-gray-500">
                Total Habits
            </div>
            <div class="mt-2 text-center text-4xl font-bold">
                {{ $totalHabits }}
            </div>
        </x-card>
        <x-card class="flex-1">
            <div class="uppercase text-center border-primary-500 text-xs tracking-wide text-gray-500">
                Tracked in past week
            </div>
            <div class="mt-2 text-center text-4xl font-bold">
                {{ $totalHabitsInPastWeek }}
            </div>
        </x-card>
    </div>
    <div class="mt-5">
        <livewire:day-grid />
    </div>
</div>
