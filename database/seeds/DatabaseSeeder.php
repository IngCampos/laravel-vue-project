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
        $this->call(TenderSectionSeeder::class);
        $this->call(TenderSeeder::class);
        $this->call(PermissionSeeder::class);

        factory(App\Models\Post::class, 30)->create();
    }
}
