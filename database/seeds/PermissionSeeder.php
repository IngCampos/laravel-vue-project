<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Permission::create(['name' => 'System Administrator', 'description' => 'Manage users and permissions.']);
        App\Permission::create(['name' => 'Complaint Administrator', 'description' => 'Read and answer the complaints.']);
        App\Permission::create(['name' => 'Advertisement Manager', 'description' => 'Manage advertisements (order, image, optional link and expiration date).']);
        App\Permission::create(['name' => 'Machine Monitor', 'description' => 'Manage the status of the machines (if it is active, no active or in maintenance).']);
        App\Permission::create(['name' => 'Tender Administrator', 'description' => 'Manage tenders(file/source, name and its section) and sections(international/national, number and year).']);
        App\Permission::create(['name' => 'Post Administrator', 'description' => 'Manage post(image, title, content, etc).']);

        // Add all the permission to the administrator
        App\User::find(1)->permissions()->sync([1, 2, 3, 4, 5, 6]);

        // Permission to some users
        App\User::find(2)->permissions()->sync([2]);
        App\User::find(3)->permissions()->sync([3]);
        App\User::find(4)->permissions()->sync([4]);
        App\User::find(5)->permissions()->sync([5]);
    }
}
