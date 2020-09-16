<?php

namespace App\Http\Livewire;

use App\Models\Habit;
use App\Models\Track;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class WeekView extends Component
{
    public $habit;
    public $current;
    public $lastDay;
    public $totalsByDay;

    protected $listeners = [
        'dayChanged' => 'dayChanged',
        'habitTracked' => '$refresh',
    ];

    public function mount(Habit $habit, $currentDay)
    {
        $this->habit = $habit;
        $this->current = $currentDay ?? null;
        $this->lastDay = today()->toDateTimeString();
    }

    public function dayChanged($day)
    {
        $this->current = $day;
    }

    public function getEndOfWeekProperty()
    {
        return new Carbon($this->lastDay);
    }

    public function getCurrentDayProperty()
    {
        return new Carbon($this->current);
    }

    public function previous()
    {
        if ($this->endOfWeek->toImmutable()->subDay(4)->greaterThan(today()->subYear()->startOfWeek(Carbon::SUNDAY))) {
            $this->lastDay = $this->endOfWeek->subDay()->toDateTimeString();
        }
    }

    public function next()
    {
        if ($this->endOfWeek->lessThan(today())) {
            $this->lastDay = $this->endOfWeek->addDay()->toDateTimeString();
        }
    }

    public function selectDay($day)
    {
        $this->current = $day;
        $this->emit('daySelected', $day);
    }

    public function render()
    {
        return view('livewire.week-view', [
            'daysInWeek' => CarbonPeriod::create($this->endOfWeek->toImmutable()->subDay(4), $this->endOfWeek),
            'totals' => Track::selectRaw('quantity, DATE(tracked_on) as day')
                ->when($this->habit, function ($query) {
                    return $query->where('habit_id', $this->habit->id);
                })
                ->groupBy('day', 'quantity')
                ->get()
                ->pluck('quantity', 'day'),
        ]);
    }
}
