<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tender;
use Faker\Generator as Faker;

$factory->define(Tender::class, function (Faker $faker) {
    $internal_file = $faker->numberBetween($min = 0, $max = 1);
    if ($internal_file)
        $link = '/storage/tenders/' . $faker->image('public/storage/tenders', 640, 480, 'cats', null, false, 'Faker');
    else
        $link = $faker->imageUrl($width = 640, $height = 480, 'cats');
    return [
        'internal_file' => $internal_file,
        'name' => $faker->catchPhrase,
        'link' => $link,
        'tender_section_id' => $faker->numberBetween($min = 1, $max = 5) // possible number of sections
    ];
});
