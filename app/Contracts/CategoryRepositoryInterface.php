<?php

namespace App\Contracts;

use App\Models\Category;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function allCategories();

    public function createCategory(Request $request);

    public function showCategory(Category $category);

    public function updateCategory(Request $request, Category $category);

    public function deleteCategory(Category $category);
}