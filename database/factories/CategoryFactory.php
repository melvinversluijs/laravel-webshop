<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Slug;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $model = Category::class;

    /**
     * @return array{
     *      code: string,
     *      name: string,
     *      slug: Slug
     * }
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->uuid,
            'name' => $this->faker->text(30),
            'slug' => new Slug(['slug' => $this->faker->slug]),
        ];
    }
}
