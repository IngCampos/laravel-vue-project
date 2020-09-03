<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $advertisements = [
            [
                'order' => 1,
                'image_source' => '/storage/ads/' . $faker->image('public/storage/ads', 1000, 333, 'cats', null, false, 'Faker'),
                'link' => $faker->imageUrl(800, 600, 'business'),
                'expiration' => $faker->date($format = 'Y-m-d', $max  = 'now', $timezone = null)
            ], [
                'order' => 2,
                'image_source' => '/storage/ads/' . $faker->image('public/storage/ads', 1000, 333, 'cats', null, false, 'Faker'),
                'link' => $faker->imageUrl(800, 600, 'business'),
                'expiration' => (date("Y") + 1) . '-' . $faker->date($format = 'm-d', $max  = 'now', $timezone = null)
            ], [
                'order' => 4,
                'image_source' => '/storage/ads/' . $faker->image('public/storage/ads', 1000, 333, 'cats', null, false, 'Faker'),
                'link' => ''
            ]
        ];

        foreach ($advertisements as $advertisement) App\Advertisement::create($advertisement);
    }
}
