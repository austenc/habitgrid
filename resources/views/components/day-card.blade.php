@props(['unit', 'total', 'date', 'selected'])

<div {{ $attributes }} class="{{ $selected ? 'border-primary-500 hover:border-primary-600' : 'border-transparent' }} cursor-pointer flex-1 flex flex-col rounded shadow bg-gray-100 border-b-4 hover:border-gray-300 transform hover:-translate-y-2 transition duration-300">
    <div class="p-3 bg-gray-300 rounded-t border-b border-gray-400">
        <div class="flex justify-between items-center text-sm">
            <div class="font-bold uppercase">
                {{ $date->format('D') }}
            </div>
            <div class="font-mono">{{ $date->format('m/d') }}</div>
        </div>
    </div>
    <div class="p-5 flex-grow">
        <div class="text-4xl font-bold">{{ $total }}</div>
        <div class="text-xs font-normal uppercase tracking-wide text-gray-500">{{ $unit }}</div>
    </div>
</div>