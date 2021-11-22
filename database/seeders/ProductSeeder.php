<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Slug;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
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
        Product::factory()->has(Slug::factory())->create([
            'name' => $name,
            'sku' => Str::snake($name),
        ]);
    }
}
