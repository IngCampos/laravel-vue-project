<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Machine;
use Faker\Generator as Faker;

$factory->define(Machine::class, function (Faker $faker) {
    return [
        'user_agent' => $faker->userAgent,
        'machine_state_id' => $faker->numberBetween($min = 1, $max = 3), // number of posibles states
        'common_failures' => json_encode($faker->sentences($nb = $faker->numberBetween($min = 0, $max = 10), $asText = false))
    ];
});
