<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ComplaintSeeder::class);
        $this->call(AdvertisementSeeder::class);
        $this->call(MachineSeeder::class);
        $this->call(TenderSectionSeeder::class);
        $this->call(TenderSeeder::class);
        $this->call(PermissionSeeder::class);

        factory(App\Post::class, 10)->create();
    }
}
