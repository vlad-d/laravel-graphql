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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(\App\Models\Artist::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'born_on' => $faker->dateTimeBetween('-60 years', '-16 years'),
    ];
});

$factory->define(\App\Models\Album::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(3),
        'genre' => \App\Models\Album::getGenres()[array_rand(\App\Models\Album::getGenres())],
        'release_date' => $faker->dateTimeBetween('-3 year', '+3 months'),
        'main_artist_id' => function () {
            return factory(\App\Models\Artist::class)->create()->id;
        }
    ];
});

$factory->define(\App\Models\Song::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(4),
        'length' => rand(120, 420),
        'album_id' => function () {
            return factory(\App\Models\Album::class)->create()->id;
        }
    ];
});
