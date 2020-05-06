<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PollOption;
use App\User;
use App\Vote;
use Faker\Generator as Faker;

$factory->define(Vote::class, function (Faker $faker) {
    return [
        'option_id' => function () {
            return PollOption::all()->random()->id;
        },
        'user_id' => function () {
            return User::all()->random()->id;
        },
    ];
});
