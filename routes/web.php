<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HabitController@index');

Route::resource('habits', 'HabitController');
