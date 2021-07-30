<?php

declare(strict_types=1);

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\Slug;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Form extends Component
{
    public Category $category;
    public Slug $slug;

    public function render(): View
    {
        return ViewFacade::make('livewire.categories.form', [
            'category' => $this->category,
        ]);
    }

    public function mount(?Category $category = null): void
    {
        if ($category === null) {
            $category = new Category();
        }

        $this->category = $category;
        $this->slug = $category->slug()->firstOrNew();
    }

    /**
     * @param mixed $property
     * @throws ValidationException
     */
    public function updated(mixed $property): void
    {
        $this->validateOnly($property);
    }

    public function saveCategory(): void
    {
        $this->validate();
        $this->category->save();
        $this->category->slug()->save($this->slug);

        $this->redirectRoute('categories');
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $alphaNumeric = ['required', 'alpha_dash', 'min:3', 'max:255'];
        return [
            'category.code' => [
                ...$alphaNumeric,
                Rule::unique('categories', 'code')->ignoreModel($this->category),
            ],
            'category.name' => 'required|min:3|max:255',
            'slug.slug' => [
                ...$alphaNumeric,
                Rule::unique('slugs', 'slug')->ignoreModel($this->slug),
            ],
        ];
    }
}
