<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => App\Customer::where('money', '>' , 50000)->get()->random()->id,
        'total' => 0
    ];
});
