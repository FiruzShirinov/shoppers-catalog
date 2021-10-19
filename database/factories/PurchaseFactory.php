<?php

namespace Database\Factories;

use App\Models\Shopper;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shopper_id' => Shopper::all()->random()->id,
            'total' => $this->faker->numberBetween(100, 999999999999)
        ];
    }
}
