<?php

namespace App\View\Components;

use Carbon\CarbonPeriod;
use Illuminate\View\Component;

class DayGrid extends Component
{
    public function render()
    {
        return view('components.day-grid')->with([
            'weeks' => CarbonPeriod::create(today()->subYear()->addDay(), '1 week', today()),
            'days' => CarbonPeriod::create(today()->subYear()->addDay(), today()),
        ]);
    }
}
