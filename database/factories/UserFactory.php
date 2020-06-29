<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Country;
use App\Gender;
use App\State;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $username = $faker->username;
    $slug = Str::of($username)->slug('-');
    $hasDescription = $faker->boolean();
    $country = Country::all()->random()->id;
    $state = $country === 1 ? State::all()->random()->id : null;

    return [
        'username' => $username,
        'slug' => $slug,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'avatar' => 'https://api.adorable.io/avatars/200/' . $slug . '.png',
        'description' => $hasDescription ? $faker->paragraph($faker->numberBetween(1, 4)) : null,
        'age' => $faker->numberBetween(13, 65),
        'gender_id' => function () {
            return Gender::all()->random()->id;
        },
        'country_id' => $country,
        'state_id' => $state,
    ];
});
