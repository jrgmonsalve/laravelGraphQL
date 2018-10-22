<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'photo' => $faker->word.".jpg",
        'parent_category_id' => null,
    ];
});
