<?php

namespace App\View\Components;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\View\Component;

class DayGrid extends Component
{
    public function render()
    {
        return view('components.day-grid')->with([
            'weeks' => CarbonPeriod::create(today()->subYear()->startOfWeek(Carbon::SUNDAY), '1 week', today()),
            'days' => CarbonPeriod::create(today()->subYear()->startOfWeek(Carbon::SUNDAY), today()),
        ]);
    }
}
