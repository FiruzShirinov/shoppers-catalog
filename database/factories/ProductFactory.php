<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Shopper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Samsung', 'Nokia', 'Xiaomi', 'Huawei', 'Oppo', 'Sony', 'HTC', 'LG']).' '.$this->faker->numberBetween(1, 1000).Str::random(1),
            'SKU' => $this->faker->uuid(),
            'price' => $this->faker->randomFloat(2, 0, 9999)*100,
            'image' => 'https://picsum.photos/800/600',
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ];
    }
}
