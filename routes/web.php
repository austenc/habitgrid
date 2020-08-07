<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', 'DashboardController')->name('dashboard');

Route::resource('habits', 'HabitController');
