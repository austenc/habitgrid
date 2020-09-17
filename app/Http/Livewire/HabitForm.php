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
        $this->habit->save();
        $this->emitUp('saved');
    }
}
