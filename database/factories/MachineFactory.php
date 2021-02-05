<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Machine;
use Faker\Generator as Faker;

$factory->define(Machine::class, function (Faker $faker) {
    return [
        'user_agent' => $faker->userAgent,
        'machine_state_id' => rand(1, 3), // number of posibles states
        'common_failures' => json_encode($faker->sentences($nb = rand(0, 10), $asText = false))
    ];
});
