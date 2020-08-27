<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Habit;
use App\User;
use Faker\Generator as Faker;

$factory->define(Habit::class, function (Faker $faker) {
    return [
        'name' => $faker->catchPhrase,
        'user_id' => factory(User::class),
    ];
});
