<?php

namespace Database\Seeders\Order;

use App\Modules\Order\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->count(3)
            ->hasItems(2)
            ->create();
    }
}
