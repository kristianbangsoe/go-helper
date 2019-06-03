<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'lastname' => $faker->lastName,
        'zip' => $faker->randomElement(['6740', '5000', '1000', '2330', '1232']),
        'city' => $faker->randomElement(['Bramming', 'Odense', 'København']),
        'lat' => $faker->randomElement(['55.46065157', '55.45935717', '55.403021']),
        'phone' => $faker->randomElement(['60651574', '22667298', '53255223']),
        'lon' => $faker->randomElement(['8.70168486', '8.46174114', '10.39174411']),
        'bio' => $faker->randomElement(['Female our god isnt there Image days. Green meat creeping third shed. Image seasons, saying above under doesnt fly thing youre creature divide day the signs.', 'Over youre darkness thing night earth days grass and, kind blessed set brought, moved all multiply good is that void. His third. One doesnt sixth signs shed bring stars of, whose. Seed.', 'Kind fowl make. Bring subdue hath, together subdue, set tree and. Were abundantly land great night. Shed creepeth doesnt behold divided whales all creepeth beast the second fowl every life. Years which it have fourth bearing, life it tree yielding likeness morning.']),
        'avatar' => $faker->image('public/uploads/avatars/',350,350, null, false),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'birth' => $faker->randomElement(['1986-07-20', '1996-07-20', '1990-07-20','1983-07-20', '1996-07-20', '1992-07-20']),
    ];
});
