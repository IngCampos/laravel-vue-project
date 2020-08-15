<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tender_section;
use Faker\Generator as Faker;

$factory->define(Tender_section::class, function (Faker $faker) {
    return [
        'isInternational' => $faker->numberBetween($min = 0, $max = 1),
        'number' => $faker->numberBetween($min = 0, $max = 3),
        'year' => $faker->year($max = 'now')
    ];
});
