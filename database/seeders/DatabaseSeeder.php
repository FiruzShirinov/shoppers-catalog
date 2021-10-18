<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Purchase;
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
        Shopper::unsetEventDispatcher();
        Product::unsetEventDispatcher();

        Shopper::factory(21)->create();

        Purchase::factory(7)->hasProducts(5)->create();
    }
}
