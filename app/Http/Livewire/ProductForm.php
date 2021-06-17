<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Redirector;

class ProductForm extends Component
{
    public Product $product;

    /**
     * @var array<string, string>
     */
    protected array $rules = [
        'product.name' => 'required|min:3|max:255',
        'product.sku' => 'required|alpha_dash|min:3|max:255',
        'product.slug' => 'required|alpha_dash|min:3|max:255',
        'product.price' => 'required|numeric|min:0',
    ];

    /**
     * @param mixed $property
     * @throws ValidationException
     */
    public function updated(mixed $property): void
    {
        $this->validateOnly($property);
    }

    public function saveProduct(): Redirector
    {
        $this->validate();
        $this->product->save();

        // @phpstan-ignore-next-line -- Return type of Redirect::route() is modified because of the Livewire component.
        return Redirect::route('products');
    }

    public function mount(mixed $product = null): void
    {
        if (!$product instanceof Product) {
            $product = new Product();
        }

        $this->product = $product;
    }

    public function render(): View
    {
        return ViewFacade::make('livewire.product-form', [
            'product' => $this->product,
        ]);
    }
}
