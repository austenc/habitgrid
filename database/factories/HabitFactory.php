<?php

namespace Database\Factories;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HabitFactory extends Factory
{
    protected $model = Habit::class;

    public function definition()
    {
        return [
            'name' => $this->faker->catchPhrase,
            'user_id' => User::factory(),
        ];
    }
}
