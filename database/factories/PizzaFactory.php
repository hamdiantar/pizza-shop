<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use \App\Models\Pizza;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



$factory->define(Pizza::class, function (Faker $faker) {
    return [
        'flavor' => $faker->name,
        'price' => $faker->numberBetween(1, 123344444444444),
    ];
});
