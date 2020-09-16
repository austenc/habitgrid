<?php

namespace Database\Factories;

use App\Models\Habit;
use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackFactory extends Factory
{
    protected $model = Track::class;

    public function definition()
    {
        return [
            'habit_id' => Habit::factory(),
            'quantity' => $this->faker->randomDigitNotNull,
            'tracked_on' => $this->faker->dateTime(),
        ];
    }
}
