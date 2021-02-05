<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Complaint;
use Faker\Generator as Faker;

$factory->define(Complaint::class, function (Faker $faker) {
    $date = $faker->dateTimeThisYear($max = 'now', $timezone = null);
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'complaint_type_id' => rand(1, 3),
        'content' => $faker->text,
        'created_at' => $date,
        'updated_at' => $date
    ];
});
