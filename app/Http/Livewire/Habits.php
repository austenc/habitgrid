<?php

namespace App\Http\Livewire;

use App\Models\Habit;
use Livewire\Component;

class Habits extends Component
{
    public $showForm = false;

    public function render()
    {
        return view('livewire.habits', [
            'habits' => Habit::all(),
        ]);
    }
}
