<div class="flex space-x-2">
    <div class="space-y-1.5">
        <div class="leading-4">&nbsp;</div>
        @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
            <div class="text-xs leading-4 text-gray-500">
                {!! $loop->even ? $dayName : '&nbsp;' !!}
            </div>
        @endforeach
    </div>

    <div class="">
        <div class="w-full flex space-x-1.5 text-xs text-gray-500">
            @foreach ($weeks as $week)
                <div class="w-4 h-4">
                    @if ($week->format('d') <= 7)
                        {{ $week->format('M') }}
                    @endif
                </div>
            @endforeach
        </div>

        <div class="flex space-x-1.5 leading-4 mt-1">
            @foreach (array_chunk($days->toArray(), 7) as $week)
                <div class="space-y-1.5">
                    @foreach ($week as $day)
                        <x-tooltip :title="$day->format('M d, Y')" class="block whitespace-no-wrap bg-gray-400 hover:bg-primary-300 w-4 h-4 rounded">
                            <span class="inline-block w-full h-full">
                                <span class="sr-only">{{ $day->format('Y-m-d') }}</span>
                            </span>
                        </x-tooltip>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>