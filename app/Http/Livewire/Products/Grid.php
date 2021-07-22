<?php

declare(strict_types=1);

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Livewire\Component;

class Grid extends Component
{
    public function render(): View
    {
        return ViewFacade::make('livewire.products.grid', [
            'products' => Product::all(),
        ]);
    }

    public function deleteProduct(int $id): void
    {
        Product::findOrFail($id)->delete();
    }
}
