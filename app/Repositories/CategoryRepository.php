<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function allCategories()
    {
        return Category::all();
    }

    public function createCategory(Request $request)
    {
        return Category::create($request->all());
    }

    public function showCategory($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory(Request $request, Category $category)
    {
        return $category->update($request->all());
    }

    public function deleteCategory(Category $category)
    {
        return $category->delete($category);
    }
}
