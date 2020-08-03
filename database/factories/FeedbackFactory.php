<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feedback;
use Faker\Generator as Faker;

$factory->define(Feedback::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'content' => $faker->text(200),
        'email' => $faker->safeEmail
    ];
});
