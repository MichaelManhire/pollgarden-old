<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Like;
use App\User;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'comment_id' => function () {
            return Comment::all()->random()->id;
        },
        'user_id' => function () {
            return User::all()->random()->id;
        },
    ];
});
