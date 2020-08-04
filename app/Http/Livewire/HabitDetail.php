<?php

namespace App\Http\Livewire;

use App\Habit;
use Livewire\Component;

class HabitDetail extends Component
{
    public $habit;

    protected $listeners = ['habitTracked'];

    public function mount(Habit $habit)
    {
        $this->habit = $habit;
    }

    public function habitTracked($habitId)
    {
        $this->habit = Habit::findOrFail($habitId);
    }

    public function render()
    {
        return view('livewire.habit-detail');
    }
}
