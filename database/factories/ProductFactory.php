<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * @return array{
     *      name: string,
     *      sku: string,
     *      price: int,
     * }
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text,
            'sku' => $this->faker->uuid,
            'price' => $this->faker->numberBetween(1, 999999),
        ];
    }
}
