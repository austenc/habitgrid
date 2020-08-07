<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HabitController@index');

Route::get('/dashboard', 'HabitController@index')->name('dashboard');

Route::resource('habits', 'HabitController');
