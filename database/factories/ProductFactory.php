<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text(128),
        'price' => $faker->randomFloat(2,1,100),
        'photo1' => $faker->word.".jpg",
        'photo2' => $faker->word.".jpg",
        'photo3' => $faker->word.".jpg",
        'category_id' => $faker->randomElement([2,4,5,9,10])
    ];
});
