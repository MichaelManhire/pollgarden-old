<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Poll;
use App\PollCategory;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Poll::class, function (Faker $faker) {
    $title = Str::replaceLast('.', '?', $faker->sentence);
    $slug = Str::of($title)->slug('-') . '-' . rand();

    return [
        'category_id' => function () {
            return PollCategory::all()->random()->id;
        },
        'user_id' => function () {
            return User::all()->random()->id;
        },
        'title' => $title,
        'slug' => $slug,
        'image' => null,
    ];
});
