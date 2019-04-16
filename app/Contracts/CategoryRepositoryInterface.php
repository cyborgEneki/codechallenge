<?php

namespace App\Contracts;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

interface CategoryRepositoryInterface
{
    public function allCategories();

    public function createCategory(CategoryRequest $request);

    public function showCategory($id);

    public function updateCategory(CategoryRequest $request, Category $category);

    public function deleteCategory(Category $category);
}