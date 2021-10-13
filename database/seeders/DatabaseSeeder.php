<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shopper;
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
        Shopper::factory(2100)->create();
        Product::factory(3100)->create();
    }
}
