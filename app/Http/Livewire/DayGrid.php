<?php

namespace App\Http\Livewire;

use App\Habit;
use App\Track;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class DayGrid extends Component
{
    public $habit;
    public $selected = null;

    protected $listeners = ['daySelected', 'dayUnselected'];

    public function mount($habit = null)
    {
        $this->habit = $habit;
    }

    public function daySelected($day)
    {
        $this->selected = $day;
    }

    public function dayUnselected()
    {
        $this->selected = null;
    }

    public function getHabitsProperty()
    {
        if (empty($this->selected)) {
            return [];
        }

        return Habit::with(['tracks' => function ($query) {
            return $query->whereDate('tracked_on', $this->selected);
        }])
        ->when($this->habit, function ($query) {
            return $query->where('id', $this->habit->id);
        })->get();
    }

    protected function tracksByDay()
    {
        return Track::with('habit')
            ->when($this->habit, function ($query) {
                return $query->where('habit_id', $this->habit->id);
            })
            ->whereBetween('tracked_on', [
                today()->subYear()->startOfWeek(Carbon::SUNDAY),
                today(),
            ]);
    }

    public function getHabitsByDayProperty()
    {
        return $this->tracksByDay()
            ->selectRaw('DATE(tracked_on) as day, habit_id')
            ->get()
            ->groupBy('day')->map->pluck('habit.name');
    }

    public function getTotalsByDayProperty()
    {
        return $this->tracksByDay()
            ->selectRaw('COUNT(*) as total_completed, DATE(tracked_on) as day')
            ->groupBy('day')
            ->pluck('total_completed', 'day');
    }

    public function getCarbonDayProperty()
    {
        return new Carbon($this->selected);
    }

    public function toggleDay($date)
    {
        if ($this->selected == $date) {
            $this->selected = null;
        } else {
            $this->selected = $date;
            $this->emit('dayChanged', $date);
        }
    }

    public function addTrack($habitId)
    {
        Track::create([
            'habit_id' => $habitId,
            'quantity' => 1,
            'tracked_on' => $this->selected,
        ]);

        $this->emit('habitTracked', $habitId);
    }

    public function removeTrack($habitId)
    {
        Track::where('habit_id', $habitId)
            ->whereDate('tracked_on', $this->selected)->delete();

        $this->emit('habitTracked', $habitId);
    }

    public function previous()
    {
        if ($this->carbonDay->greaterThan($this->daysFromPastYear()->first())) {
            $this->selected = $this->carbonDay->subDay()->toDateTimeString();
        }
    }

    public function next()
    {
        if ($this->carbonDay->lessThan(today())) {
            $this->selected = $this->carbonDay->addDay()->toDateTimeString();
        }
    }

    public function classForDay($day)
    {
        $classes = [];

        if ($day == $this->selected) {
            $classes[] = 'border-orange-400';
        } else {
            $classes[] = 'hover:bg-gray-500';
        }

        $classes[] = $this->colorByNumber($this->totalsByDay->get($day->format('Y-m-d')));

        return implode(' ', $classes);
    }

    public function colorByNumber($number)
    {
        if ($number >= 4) {
            return 'bg-primary-700';
        }

        if ($number >= 3) {
            return 'bg-primary-600';
        }

        if ($number >= 2) {
            return 'bg-primary-500';
        }

        if ($number >= 1) {
            return 'bg-primary-400';
        }

        return 'bg-gray-300';
    }

    protected function daysFromPastYear($interval = null)
    {
        return CarbonPeriod::create(
            today()->subYear()->startOfWeek(Carbon::SUNDAY),
            $interval,
            today()
        );
    }

    protected function daysByMonth()
    {
        return collect($this->daysFromPastYear())->groupBy(function ($date) {
            return $date->format('Y-m');
        });
    }

    public function render()
    {
        return view('livewire.day-grid')->with([
            'weeks' => $this->daysFromPastYear('1 week'),
            'days' => $this->daysFromPastYear(),
            'daysByMonth' => $this->daysByMonth(),
        ]);
    }
}
