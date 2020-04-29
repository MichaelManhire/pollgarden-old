<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Poll;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::all()->random()->id;
        },
        'title' => Str::replaceLast('.', '?', $faker->sentence),
    ];
});
