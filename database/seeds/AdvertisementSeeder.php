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
                'image_source' => 'https://loremflickr.com/320/240/cat',
                'link' => 'https://loremflickr.com/320/240/cat',
                'expiration' => $faker->date($format = 'Y-m-d', $max  = 'now', $timezone = null)
            ],
            [
                'order' => 2,
                'image_source' => 'https://loremflickr.com/320/240/dog',
                'link' => 'https://loremflickr.com/320/240/cat',
                'expiration' => (date("Y") + 1) . '-' . $faker->date($format = 'm-d', $max  = 'now', $timezone = null)
            ],
            [
                'order' => 3,
                'image_source' => 'https://loremflickr.com/320/240/cat',
            ],
            [
                'order' => 4,
                'image_source' => 'https://loremflickr.com/320/240/dog',
            ],
            [
                'order' => 5,
                'image_source' => 'https://loremflickr.com/320/240/cat',
            ]
        ];

        foreach ($advertisements as $advertisement) App\Advertisement::create($advertisement);
    }
}
