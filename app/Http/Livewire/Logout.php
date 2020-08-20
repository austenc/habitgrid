<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    protected $listeners = ['logout'];

    public function logout()
    {
        Auth::logout();
        $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
