<?php

namespace App\Http\Livewire;

use App\Habit;
use App\Track;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class DayGrid extends Component
{
    // TO DO
    // - Show grid filled in for days with a habit tracked
    // - Navigate between days easily (prev/next buttons)
    // - Default to today

    public $selected = '2019-07-28 00:00:00';

    public function toggleDay($date)
    {
        if ($this->selected == $date) {
            $this->selected = null;
        } else {
            $this->selected = $date;
        }
    }

    public function getHabitsProperty()
    {
        if (empty($this->selected)) {
            return [];
        }

        return Habit::with(['tracks' => function ($query) {
            return $query->whereDate('tracked_on', $this->selected);
        }])->get();
    }

    public function getTotalsByDayProperty()
    {
        return Track::selectRaw('COUNT(*) as total_completed, DATE(tracked_on) as day')
            ->groupBy('day')
            ->get()
            ->pluck('total_completed', 'day');
    }

    public function addTrack($habitId)
    {
        Track::create([
            'habit_id' => $habitId,
            'quantity' => 1,
            'tracked_on' => $this->selected,
        ]);
    }

    public function removeTrack($habitId)
    {
        Track::where('habit_id', $habitId)
            ->whereDate('tracked_on', $this->selected)->delete();
    }

    public function classForDay($day)
    {
        $classes = [];

        if ($day == $this->selected) {
            $classes[] = 'border-orange-400';
        } else {
            $classes[] = 'hover:bg-gray-500';
        }

        $classes[] = $this->colorFor($this->totalsByDay->get($day->format('Y-m-d')));

        return implode(' ', $classes);
    }

    public function colorFor($quantity)
    {
        if ($quantity >= 4) {
            return 'bg-primary-700';
        }

        if ($quantity >= 3) {
            return 'bg-primary-600';
        }

        if ($quantity >= 2) {
            return 'bg-primary-500';
        }

        if ($quantity >= 1) {
            return 'bg-primary-400';
        }

        return 'bg-gray-400';
    }

    public function render()
    {
        return view('livewire.day-grid')->with([
            'weeks' => CarbonPeriod::create(today()->subYear()->startOfWeek(Carbon::SUNDAY), '1 week', today()),
            'days' => CarbonPeriod::create(today()->subYear()->startOfWeek(Carbon::SUNDAY), today()),
        ]);
    }
}
