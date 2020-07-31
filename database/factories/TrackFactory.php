<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Habit;
use App\Track;
use Faker\Generator as Faker;

$factory->define(Track::class, function (Faker $faker) {
    return [
        'habit_id' => factory(Habit::class),
        'quantity' => $faker->randomDigitNotNull,
        'tracked_on' => $faker->dateTime(),
    ];
});
