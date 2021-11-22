<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SlugFactory extends Factory
{
    /**
     * @return array{
     *      slug: string,
     * }
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
        ];
    }
}
