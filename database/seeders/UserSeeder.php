<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => Hash::make('password'), 
            'role' => 'admin',
        ]);

        User::factory(10)->create([
            'role' => 'vendor',
        ]);

        User::factory(10)->create([
            'role' => 'user',
        ]);
    }
}
