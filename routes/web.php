<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::livewire('/dashboard', 'dashboard')
    ->name('dashboard')
    ->middleware('auth');

Route::resource('habits', 'HabitController')->middleware('auth');

Route::livewire('/register', 'register')->name('register');
Route::livewire('/login', 'login')->name('login');
