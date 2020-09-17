<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    protected $rules = [
        'user.name' => 'required|min:2',
        'user.email' => 'required|email',
        'user.bio' => 'sometimes',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function updatedUserEmail()
    {
        $this->validateOnly('user.email', [
            'user.email' => 'required|email|unique:users,email,'.$this->user->id,
        ]);
    }

    public function save()
    {
        $this->validate();
        $this->user->save();
        $this->toast('Saved');
    }
}
