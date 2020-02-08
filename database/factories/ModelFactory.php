<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'login' => $faker->word,
        'email' => $faker->email,
        'api_token' => Str::random(60)
    ];
});

$factory->define(\App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text(),
        'parent_id' => \App\Models\Category::inRandomOrder()->first()->id ?? null
    ];
});

$factory->define(\App\Models\Good::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->text(),
        'price' =>round( $faker->randomFloat(4, 0, 10000), 2),
        'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? null,
    ];
});

