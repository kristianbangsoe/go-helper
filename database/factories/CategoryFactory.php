<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Frisør', 'Hjemmepleje', 'Maler', 'Børnepasning', 'Dyrepasning', 'IT Support', 'Flytning', 'Havearbejde']),
        'cat_type' => $faker->randomElement(['1', '2', '3'])
    ];
});


