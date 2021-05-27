<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Faculty;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->unique()->tollFreePhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'dean_id' => factory(App\Model\User::class),
    ];
});
