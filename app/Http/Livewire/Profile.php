<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    public $photo;
    public $password;
    public $password_confirmation;

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
        $this->uploadPhoto();
        $this->changePassword();
        $this->toast('Saved');
    }

    protected function changePassword()
    {
        // We only want to validate and update the password if it's not empty
        if (empty($this->password)) {
            return;
        }

        $this->validateOnly('password', ['password' => 'min:8|confirmed']);
        $this->user->update([
            'password' => Hash::make($this->password),
        ]);
        $this->password = null;
        $this->password_confirmation = null;
    }

    protected function uploadPhoto()
    {
        $this->photo && $this->user->update([
            'photo' => $this->photo->store('profile-photos/user/'.$this->user->id, 'public'),
        ]);
        $this->photo = null;
        $this->dispatchBrowserEvent('uploaded');
        $this->emit('photoUpdated');
    }

    public function remove()
    {
        Storage::disk('public')->delete($this->user->photo);
        $this->photo = null;
        $this->user->update(['photo' => null]);
        $this->emit('photoUpdated');
    }
}
