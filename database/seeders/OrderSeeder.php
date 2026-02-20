<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalOrders = 50000;
        $chunkSize = 1000;

        try {
            for ($i = 0; $i < $totalOrders; $i += $chunkSize) {
                \App\Models\Order::factory($chunkSize)->create();
                // Simple output to track progress
                echo "Processed chunk starting at $i\n";
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}
