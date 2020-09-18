<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ProfilePhoto extends Component
{
    public User $user;

    protected $listeners = ['photoUpdated' => '$refresh'];

    public function mount()
    {
        $this->user = auth()->user();
    }
}
