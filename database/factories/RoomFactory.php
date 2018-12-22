<?php

use Faker\Generator as Faker;

$factory->define(App\Room::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'beds' => $faker->numberBetween(1,10)
    ];
});
