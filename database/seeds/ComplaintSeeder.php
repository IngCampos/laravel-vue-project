<?php

use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Complaint_type::create(['name' => 'Report']);
        App\Complaint_type::create(['name' => 'Suggestion']);
        App\Complaint_type::create(['name' => 'Other']);
        factory(App\Complaint::class, 365)->create();
    }
}
