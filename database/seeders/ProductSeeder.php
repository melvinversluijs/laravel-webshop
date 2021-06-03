<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    private Generator $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function run(): void
    {
        $products = [
            'Toy Car',
            'Lego set',
            'Puzzle',
            'Chess board',
            'Mobile phone',
            'Dumbbell',
            'Smart watch',
            'Book',
        ];

        foreach ($products as $product) {
            $this->create($product);
        }
    }

    private function create(string $name): void
    {
        Product::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'sku' => Str::snake($name),
            'price' => $this->faker->numberBetween(1, 50000),
        ]);
    }
}
