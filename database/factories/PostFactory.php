<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use Faker\Provider\Youtube as Youtube;

$factory->define(Post::class, function (Faker $faker) {
    $faker = \Faker\Factory::create();
    $faker->addProvider(new Youtube($faker));
    $content_amount = rand(0, 3);
    // 0 there are not content, 1 with image,
    // 2 with iframe and 3 with image and iframe
    return [
        'user_id' => rand(1, 100), //number of users
        'title' => $faker->sentence,
        'image' => (($content_amount == 1 || $content_amount == 3) ? 'https://loremflickr.com/320/240/cat' : ''),
        'body' => $faker->text(800),
        'iframe' => (($content_amount == 2 || $content_amount == 3) ? $faker->youtubeEmbedCode() : '')
    ];
});
