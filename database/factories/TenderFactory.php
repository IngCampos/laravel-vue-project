<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tender;
use Faker\Generator as Faker;

$factory->define(Tender::class, function (Faker $faker) {
    $internal_file = 0;
    $link = 'https://picsum.photos/500/320/?image=' . rand(1, 1084);
    return [
        'internal_file' => $internal_file,
        'name' => $faker->catchPhrase,
        'link' => $link,
        'tender_section_id' => rand(1, 5) // possible number of sections
    ];
});
