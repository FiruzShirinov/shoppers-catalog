<?php

namespace Database\Factories;

use App\Models\Shopper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShopperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shopper::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->unique()->e164PhoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password', // $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
            'image' => '/storage/'.$this->faker->image(public_path('/storage/'),300,300, null, false),
            'remember_token' => Str::random(10),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ];
    }
}
