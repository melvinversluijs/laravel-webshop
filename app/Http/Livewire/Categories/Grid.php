<?php

declare(strict_types=1);

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Livewire\Component;

class Grid extends Component
{
    public function render(): View
    {
        return ViewFacade::make('livewire.categories.grid', [
            'categories' => Category::all(),
        ]);
    }

    public function deleteCategory(int $id): void
    {
        Category::findOrFail($id)->delete();
    }
}
