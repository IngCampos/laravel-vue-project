<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Department::create(['name' => 'System Administration']);
        factory(App\Department::class, 9)->create();
    }
}
