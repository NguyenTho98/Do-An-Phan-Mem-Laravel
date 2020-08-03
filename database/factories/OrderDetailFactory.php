<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderDetail;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => App\Order::all()->random()->id,
        'productkey_id' => App\ProductKey::where('active', false)->get()->random()->id,
        'price' => 50000,
    ];
});
