<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

use function compact;

class ProductController
{
    public function index(): View
    {
        return ViewFacade::make('products.index');
    }

    public function create(): View
    {
        return ViewFacade::make('products.create');
    }

    public function edit(Product $product): View
    {
        return ViewFacade::make('products.edit', compact('product'));
    }
}
