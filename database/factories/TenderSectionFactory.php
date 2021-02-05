<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tender_section;
use Faker\Generator as Faker;

$factory->define(Tender_section::class, function (Faker $faker) {
    return [
        'isInternational' => rand(0, 1),
        'number' => rand(0, 3),
        'year' => $faker->year($max = 'now')
    ];
});
