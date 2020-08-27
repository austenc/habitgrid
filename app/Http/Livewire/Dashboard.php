<?php

namespace App\Http\Livewire;

use App\Habit;
use App\Track;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = ['habitTracked' => '$refresh'];

    public function render()
    {
        return view('livewire.dashboard', [
            'totalHabits' => Habit::count(),
            'habitWithBestStreak' => Habit::all()->sortByDesc('currentStreak.length')->first(),
            'totalHabitsInPastWeek' => Track::totalHabitsInPastWeek(),
        ]);
    }
}
