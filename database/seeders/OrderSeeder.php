<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Seed the orders table with dummy data.
     *
     * @return void
     */
    public function run()
    {
        // Define the number of dummy records
        $numOfRecords = 10;

        // Fetch existing service IDs for associating with orders
        $serviceIds = DB::table('services')->pluck('id');

        // Insert dummy data
        for ($i = 0; $i < $numOfRecords; $i++) {
            DB::table('orders')->insert([
                'user_id' => rand(1, 10), // Assuming users with IDs from 1 to 10
                'service_id' => $serviceIds->random(), // Random service ID
                'status' => ['pending', 'completed', 'canceled'][array_rand(['pending', 'completed', 'canceled'])], // Random status
                'total_price' => rand(100, 500), // Random price
                'created_at' => Carbon::now()->subDays(rand(0, 30)), // Random created date within the last 30 days
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

