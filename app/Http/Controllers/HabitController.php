<?php

namespace App\Http\Controllers;

use App\Habit;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function index()
    {
        return view('habits.index', [
            'habits' => Habit::all(),
        ]);
    }

    public function create()
    {
        //
    }

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

    public function show($id)
    {
        //
    }

    public function edit(Habit $habit)
    {
        return view('habits.edit', [
            'habit' => $habit,
        ]);
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
