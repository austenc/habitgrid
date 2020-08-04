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
    public $endOfWeek;

    protected $listeners = ['dayChanged'];

    public function mount(Habit $habit)
    {
        $this->habit = $habit;
        $this->endOfWeek = today()->toDateTimeString();
        $this->current = today()->toDateTimeString();
    }

    public function dayChanged($day)
    {
        $this->current = $day;
    }

    public function getEndOfWeekCarbonProperty()
    {
        return new Carbon($this->endOfWeek);
    }

    public function getCurrentDayProperty()
    {
        return new Carbon($this->current);
    }

    public function previous()
    {
        if ($this->endOfWeekCarbon->toImmutable()->subDay(4)->greaterThan(today()->subYear()->startOfWeek(Carbon::SUNDAY))) {
            $this->endOfWeek = $this->endOfWeekCarbon->subDay()->toDateTimeString();
        }
    }

    public function next()
    {
        if ($this->endOfWeekCarbon->lessThan(today())) {
            $this->endOfWeek = $this->endOfWeekCarbon->addDay()->toDateTimeString();
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
            'week' => CarbonPeriod::create($this->endOfWeekCarbon->toImmutable()->subDay(4), $this->endOfWeekCarbon),
        ]);
    }
}
