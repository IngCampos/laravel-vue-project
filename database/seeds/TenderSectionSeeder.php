<?php

use Illuminate\Database\Seeder;

class TenderSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Tender_section::class, 5)->create();
    }
}
