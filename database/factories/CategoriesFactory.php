<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word),
        'description' => $faker->sentence(10),
        'image' => $faker->imageUrl($width = 250, $height = 250)
    ];
});
