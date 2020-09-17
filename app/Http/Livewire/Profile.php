<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    public $photo;

    protected $rules = [
        'user.name' => 'required|min:2',
        'user.email' => 'required|email',
        'user.bio' => 'sometimes',
        'photo' => 'image|nullable|max:4096',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function updatedPhoto()
    {
        $this->validateOnly('photo', ['photo' => 'image|max:4096']);
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

        if ($this->photo) {
            $this->user->update([
                'photo' => $this->photo->store('profile-photos/user/'.$this->user->id, 'public'),
            ]);
        }
        $this->toast('Saved');
    }
}
