<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\Slug;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $model = Product::class;

    /**
     * @return array{
     *      name: string,
     *      sku: string,
     *      price: int,
     *      slug: Slug
     * }
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text,
            'sku' => $this->faker->uuid,
            'price' => $this->faker->numberBetween(1, 999999),
            'slug' => new Slug(['slug' => $this->faker->slug]),
        ];
    }
}
