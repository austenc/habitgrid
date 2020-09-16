<?php

namespace App\Http\Livewire;

use App\Models\Habit;
use Livewire\Component;

class HabitForm extends Component
{
    public Habit $habit;

    protected $rules = [
        'habit.name' => 'required',
        'habit.goal' => 'present',
        'habit.unit' => 'present',
    ];

    public function save()
    {
        $this->validate();
        $this->habit->save();
    }

    public function render()
    {
        return view('livewire.habit-form');
    }
}
