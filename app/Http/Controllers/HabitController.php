<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Habit::create($request->only([
            'name',
            'goal',
            'unit',
        ]));

        return redirect()->route('habits.index');
    }

    public function update(Request $request, Habit $habit)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $habit->update($request->only([
            'name',
            'goal',
            'unit',
        ]));

        session()->flash('message', 'Habit updated successfully.');

        return redirect()->route('habits.edit', $habit);
    }

    public function destroy($id)
    {
        //
    }
}
