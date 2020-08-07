<?php

namespace App\Http\Controllers;

use App\Habit;
use App\Track;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('dashboard', [
            'totalHabits' => Habit::count(),
            'habitWithBestStreak' => Habit::all()->sortByDesc('currentStreak.length')->first(),
            'totalHabitsInPastWeek' => Track::totalHabitsInPastWeek(),
        ]);
    }
}
