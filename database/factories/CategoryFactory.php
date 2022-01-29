<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * @return array{
     *      code: string,
     *      name: string,
     * }
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->uuid,
            'name' => $this->faker->text(30),
        ];
    }
}
