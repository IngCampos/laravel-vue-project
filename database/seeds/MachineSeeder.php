<?php

use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Machine_state::create(['name' => 'Active']);
        App\Models\Machine_state::create(['name' => 'No active']);
        App\Models\Machine_state::create(['name' => 'In maintenance']);
        factory(App\Models\Machine::class, 100)->create();
    }
}
