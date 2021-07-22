<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

use function compact;

class CategoryController
{
    public function index(): View
    {
        return ViewFacade::make('categories.index');
    }

    public function create(): View
    {
        return ViewFacade::make('categories.create');
    }

    public function edit(Category $category): View
    {
        return ViewFacade::make('categories.edit', compact('category'));
    }
}
