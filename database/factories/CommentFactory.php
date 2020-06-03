<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Poll;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'poll_id' => function () {
            return Poll::all()->random()->id;
        },
        'user_id' => function () {
            return User::all()->random()->id;
        },
        'body' => $faker->paragraph($faker->numberBetween(1, 5)),
    ];
});
