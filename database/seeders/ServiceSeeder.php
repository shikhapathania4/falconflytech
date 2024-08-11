<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the services table with dummy data.
     *
     * @return void
     */
    public function run()
    {
        // Define the number of dummy records
        $numOfRecords = 10;

        // Insert dummy data
        for ($i = 0; $i < $numOfRecords; $i++) {
            DB::table('services')->insert([
                'name' => 'Service ' . ($i + 1),
                'description' => 'Description for service ' . ($i + 1),
                'price' => rand(100, 500), // Random price between 100 and 500
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
