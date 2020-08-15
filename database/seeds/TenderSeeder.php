<?php

use Illuminate\Database\Seeder;

class TenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tender::class, 100)->create();
    }
}
