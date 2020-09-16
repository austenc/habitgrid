<?php

use App\Http\Controllers\HabitController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\HabitDetail;
use App\Http\Livewire\Habits;
use App\Http\Livewire\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', Dashboard::class)
    ->name('dashboard')
    ->middleware('auth');

Route::get('/habits', Habits::class)->name('habits.index')->middleware('auth');
Route::get('/habits/{habit}', HabitDetail::class)->name('habits.edit')->middleware('auth');

Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/profile', Profile::class)->name('profile')->middleware('auth');
