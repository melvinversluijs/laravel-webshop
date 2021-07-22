<?php

declare(strict_types=1);

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Form extends Component
{
    public Product $product;

    /**
     * @var array<string, string>
     */
    protected array $rules = [
        'product.name' => 'required|min:3|max:255',
        'product.sku' => 'required|alpha_dash|min:3|max:255',
        'product.price' => 'required|numeric|min:0',
    ];

    public function render(): View
    {
        return ViewFacade::make('livewire.products.form', [
            'product' => $this->product,
        ]);
    }

    public function mount(?Product $product = null): void
    {
        if ($product === null) {
            $product = new Product();
        }

        $this->product = $product;
    }

    /**
     * @param mixed $property
     * @throws ValidationException
     */
    public function updated(mixed $property): void
    {
        $this->validateOnly($property);
    }

    public function saveProduct(): void
    {
        $this->validate();
        $this->product->save();

        $this->redirectRoute('products');
    }
}
