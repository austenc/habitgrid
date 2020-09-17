<?php

namespace App\Http\Livewire;

use App\Models\Habit;
use Livewire\Component;

class HabitDetail extends Component
{
    public Habit $habit;

    protected $listeners = ['habitTracked'];

    public function habitTracked($habitId)
    {
        $this->habit = Habit::findOrFail($habitId);
    }
}
