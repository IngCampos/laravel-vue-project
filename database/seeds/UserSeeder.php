<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Administrator',
            'email' => 'admin@laravel-vue.com',
            'department_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('laravel'),
            'remember_token' => Str::random(10),
        ]);
        factory(App\User::class, 100)->create();
    }
}
