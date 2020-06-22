<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\UserCareer;
use App\UserCountry;
use App\UserEducationLevel;
use App\UserEthnicity;
use App\UserGender;
use App\UserOrientation;
use App\UserPolitics;
use App\UserReligion;
use App\UserState;
use App\UserZodiacSign;
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
    $country = UserCountry::all()->random()->id;
    $state = $country === 1 ? UserState::all()->random()->id : null;

    return [
        'username' => $username,
        'slug' => $slug,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'avatar' => 'https://api.adorable.io/avatars/200/' . $slug . '.png',
        'description' => $hasDescription ? $faker->paragraph($faker->numberBetween(1, 4)) : null,
        'age' => $faker->numberBetween(13, 65),
        'gender_id' => function () {
            return UserGender::all()->random()->id;
        },
        'country_id' => $country,
        'state_id' => $state,
        'education_level_id' => function () {
            return UserEducationLevel::all()->random()->id;
        },
        'career_id' => function () {
            return UserCareer::all()->random()->id;
        },
        'ethnicity_id' => function () {
            return UserEthnicity::all()->random()->id;
        },
        'orientation_id' => function () {
            return UserOrientation::all()->random()->id;
        },
        'zodiac_sign_id' => function () {
            return UserZodiacSign::all()->random()->id;
        },
        'religion_id' => function () {
            return UserReligion::all()->random()->id;
        },
        'politics_id' => function () {
            return UserPolitics::all()->random()->id;
        },
    ];
});
