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
        App\Models\Complaint_type::create(['name' => 'Report']);
        App\Models\Complaint_type::create(['name' => 'Suggestion']);
        App\Models\Complaint_type::create(['name' => 'Other']);
        factory(App\Models\Complaint::class, 365)->create();
    }
}
