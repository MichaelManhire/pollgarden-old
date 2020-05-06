<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PollOption;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(PollOption::class, function (Faker $faker) {
    return [
        'name' => Str::ucfirst($faker->words($faker->numberBetween(1, 5), true)),
    ];
});
