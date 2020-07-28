<?php

namespace App\Http\Controllers;

use App\Habit;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function index()
    {
        return view('habits.index')->with([
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
        return view('habits.edit')->with(['habit' => $habit]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
