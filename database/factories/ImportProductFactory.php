<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImportProduct;
use Faker\Generator as Faker;

$factory->define(ImportProduct::class, function (Faker $faker) {
    return [
        'publisher_id' => App\Publisher::all()->random()->id,
        'product_id' => App\Product::all()->random()->id,
        'import_price' => $faker->numberBetween(10000, 50000),
    ];
});
