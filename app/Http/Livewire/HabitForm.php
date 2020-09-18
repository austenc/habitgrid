<?php

namespace App\Http\Livewire;

use App\Models\Habit;
use Livewire\Component;

class HabitForm extends Component
{
    public Habit $habit;

    public function mount(Habit $habit)
    {
        $this->habit = $habit ?? new Habit;
    }

    protected $rules = [
        'habit.name' => 'required',
        'habit.goal' => 'present',
        'habit.unit' => 'present',
    ];

    public function save()
    {
        $this->validate();
        $creating = empty($this->habit->id);
        $this->habit->save();
        $this->emitUp('saved');
        $creating && $this->dispatchBrowserEvent('habit-created');
        $creating && $this->habit = new Habit;
        $this->toast($creating ? 'Habit created, now follow through!' : 'Updated');
    }
}
