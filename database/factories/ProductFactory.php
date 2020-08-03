<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->name;
    $slug = Str::slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
        'category_id' => App\Category::all()->random()->id,
        'picture'=> 'upload\gtaV.jpg',
        'info' => $faker->text(1000)
    ];
});
