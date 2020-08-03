<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recharge;
use Faker\Generator as Faker;

$factory->define(Recharge::class, function (Faker $faker) {
    return [
        'customer_id' => App\Customer::all()->random()->id,
        'total' => 100000
    ];
});
