<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use App\Entities\Admin\User;
use Faker\Generator as Faker;

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
    /*
        'first_name'
        'last_name'
        'email'
        'username'
        'password'
        'email_verified_at'
        'start_date'
        'end_date'
    */

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->word,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'start_date' => ($start = $faker->dateTimeBetween('-5 years', 'now')),
        'email_verified_at' => $faker->randomElement([null, ($validated = $faker->dateTimeBetween($start, 'now'))]),
        'end_date' => $faker->randomElement([null, $faker->dateTimeBetween($validated, 'now')]),
        'remember_token' => Str::random(10),
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
