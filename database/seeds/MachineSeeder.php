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
        App\Machine_state::create(['name' => 'Active']);
        App\Machine_state::create(['name' => 'No active']);
        App\Machine_state::create(['name' => 'In maintenance']);
        factory(App\Machine::class, 100)->create();
    }
}
