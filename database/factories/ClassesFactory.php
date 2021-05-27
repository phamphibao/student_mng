<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Classes;
use Faker\Generator as Faker;

$factory->define(Classes::class, function (Faker $faker) {
    return [
        'name' => $faker->postcode,
        'teacher_id' => factory(App\Model\User::class),
    ];
});
