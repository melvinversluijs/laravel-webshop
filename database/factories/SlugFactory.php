<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Slug>
 */
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
