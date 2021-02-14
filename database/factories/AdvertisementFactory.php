<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advertisement;
use Faker\Generator as Faker;

$factory->define(Advertisement::class, function (Faker $faker) {
    $status = [
        // status 1: advertisement without expiration
        null,
        // status 2: advertisement with with expired expiration
        $faker->date($format = 'Y-m-d', $max  = 'now', $timezone = null),
        // status 1: advertisement with with expiration
        (date("Y") + 1) . '-' . $faker->date($format = 'm-d', $max  = 'now', $timezone = null)
    ];

    return [
        'image_source' => 'https://loremflickr.com/320/240/cat',
        'expiration' => $status[rand(0,2)]
    ];
});
