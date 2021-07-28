<?php

declare(strict_types=1);

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\Slug;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Form extends Component
{
    public Product $product;
    public Slug $slug;

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
        $this->slug = $product->slug()->firstOrNew();
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
        $this->product->slug()->save($this->slug);

        $this->redirectRoute('products');
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $alphaDashValidation = ['required', 'alpha_dash', 'min:3', 'max:255'];
        return [
            'product.name' => 'required|min:3|max:255',
            'product.sku' => [
                ...$alphaDashValidation,
                Rule::unique('products', 'sku')->ignoreModel($this->product),
            ],
            'slug.slug' => [
                ...$alphaDashValidation,
                Rule::unique('slugs', 'slug')->ignoreModel($this->slug),
            ],
            'product.price' => 'required|numeric|min:0',
        ];
    }
}
