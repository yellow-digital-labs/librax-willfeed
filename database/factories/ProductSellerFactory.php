<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSeller>
 */
class ProductSellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "seller_id" => 2,
            "product_id" => $this->faker->randomElement(['1', '2', '3', '4', '5', '9']),
            "amount_before_tax" => $this->faker->randomFloat(2, 0, 2),
            "amount_30gg" => $this->faker->randomFloat(2, 0, 2),
            "amount_60gg" => $this->faker->randomFloat(2, 0, 2),
            "amount_90gg" => $this->faker->randomFloat(2, 0, 2),
            "tax" => 22.00,
            "amount" => $this->faker->randomFloat(2, 0, 2),
            "current_stock" => $this->faker->randomNumber(5, false),
            "add_vat_to_price" => $this->faker->randomElement(['yes', 'no']),
            "status" => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
