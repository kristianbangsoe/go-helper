<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(200),
        'user_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8']),
        'worker_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8']),
        'category_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8']),
        'rating' => $faker->randomElement(['1', '2', '3', '4', '5']),
        'status' => '1', 
        'rating_comment' => $faker->randomElement(['Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'It was popularised in the 1960s with the release of Letraset sheets.', 'Morten er en god lære'])
    ];
});
