<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($data, $this->remember)) {
            return redirect()->intended('/dashboard');
        }

        $this->addError('password', 'Invalid email/password combination.');
    }
}
