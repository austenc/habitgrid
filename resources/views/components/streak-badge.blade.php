@props(['habit'])

@if ($habit->currentStreak->exists)
    <div class="inline-flex text-sm items-center py-px px-3 bg-teal-200 text-teal-700 rounded-full">
        {{ $habit->currentStreak->length }} day streak!
    </div>
@endif