<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Complaint;
use Faker\Generator as Faker;

$factory->define(Complaint::class, function (Faker $faker) {
    $date = $faker->dateTimeThisYear($max = 'now', $timezone = null);
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'complaint_type_id' => $faker->numberBetween($min = 1, $max = 3),
        'content' => $faker->text,
        'created_at' => $date,
        'updated_at' => $date
    ];
});
