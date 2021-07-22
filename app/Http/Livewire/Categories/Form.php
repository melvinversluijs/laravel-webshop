<?php

declare(strict_types=1);

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Form extends Component
{
    public Category $category;

    /**
     * @var array<string, string>
     */
    protected array $rules = [
        'category.code' => 'required|alpha_dash|min:3|max:255',
        'category.name' => 'required|min:3|max:255',
    ];

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

        $this->redirectRoute('categories');
    }
}
