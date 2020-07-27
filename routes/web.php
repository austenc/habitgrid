<?php

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home')->with([
        'weeks' => CarbonPeriod::create(today()->subYear()->addDay(), '1 week', today()),
        'days' => CarbonPeriod::create(today()->subYear()->addDay(), today()),
    ]);
});
