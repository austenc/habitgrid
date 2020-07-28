@props(['unit', 'total', 'date'])

<div class="flex-1 flex flex-col rounded shadow bg-white border-t-4 border-transparent hover:border-primary-200 transition-all duration-300">
    <div class="p-5 flex-grow">
        <div class="text-4xl font-bold">{{ $total }}</div>
        <div class="text-xs font-normal uppercase tracking-wide text-gray-500">{{ $unit }}</div>
        {{ $badge ?? '' }}
    </div>


    <div class="p-3 bg-gray-700 rounded-b">
        <div class="flex justify-between items-center text-sm">
            <div class="font-bold uppercase">
                {{ $date->format('D') }}
            </div>
            <div class="font-mono">{{ $date->format('m/d') }}</div>
        </div>
    </div>
</div>