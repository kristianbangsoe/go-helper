<?php

use Faker\Generator as Faker;

$factory->define(App\UserCategories::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8']),
        'category_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8']),
        'experince' => $faker->randomElement(['1', '2', '3']),
        'description' => $faker->randomElement(['Jeg er super god til ditten og datten', 'Jeg elsker at kode', 'Vi koder til vi dør']),
    ];
});
