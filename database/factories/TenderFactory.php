<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tender;
use Faker\Generator as Faker;

$factory->define(Tender::class, function (Faker $faker) {
    $internal_file = $faker->numberBetween($min = 0, $max = 1);
    if ($internal_file)
        $link = $faker->image('public/storage', 640, 480, null, false);
    else
        $link = $faker->imageUrl($width = 640, $height = 480);
    return [
        'internal_file' => $internal_file,
        'name' => $faker->catchPhrase,
        'link' => $link,
        'tender_section_id' => $faker->numberBetween($min = 1, $max = 10) // posible number of sections
    ];
});
