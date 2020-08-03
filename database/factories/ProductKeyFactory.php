<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductKey;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ProductKey::class, function (Faker $faker) {
    return [
        'importproduct_id' => App\ImportProduct::all()->random()->id,
        'key' => Str::random(12)
    ];
});
