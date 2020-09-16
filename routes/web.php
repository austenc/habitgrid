<?php

use App\Http\Controllers\HabitController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', Dashboard::class)
    ->name('dashboard')
    ->middleware('auth');

Route::resource('habits', HabitController::class)->middleware('auth');

Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
