<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Poll;
use App\PollCategory;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'category_id' => function () {
            return PollCategory::all()->random()->id;
        },
        'user_id' => function () {
            return User::all()->random()->id;
        },
        'title' => Str::replaceLast('.', '?', $faker->sentence),
    ];
});
