@props(['field'])

<label x-data="{ on: @entangle($field).defer }" @click="on = !on" class="flex items-center text-gray-500 text-sm cursor-pointer">
    <span :class="{ 'bg-gray-200': !on, 'bg-primary-400': on }" class="transition-all duration-300 flex items-center rounded-full w-9 h-4">
        <span :class="{ 'translate-x-0': !on, 'translate-x-5': on }" class="transition duration-300 transform block w-4 h-4 bg-white shadow rounded-full"></span>
    </span>@if (!$slot->isEmpty())<span class="inline-block ml-1.5">{{ $slot }}</span>@endif
</label>