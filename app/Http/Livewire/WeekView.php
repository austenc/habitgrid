<?php

namespace App\Http\Livewire;

use App\Habit;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class WeekView extends Component
{
    public $habit;
    public $current;
    public $lastDay;

    protected $listeners = ['dayChanged'];

    public function mount(Habit $habit, $currentDay = null)
    {
        $this->habit = $habit;
        $this->current = $currentDay;
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

    public function getStartOfWeekProperty()
    {
        return $this->endOfWeek->toImmutable()->subDay(4);
    }

    public function getCurrentDayProperty()
    {
        return new Carbon($this->current);
    }

    public function previous()
    {
        if ($this->startOfWeek->greaterThan(today()->subYear()->startOfWeek(Carbon::SUNDAY))) {
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
            'week' => CarbonPeriod::create($this->startOfWeek, $this->endOfWeek),
        ]);
    }
}
