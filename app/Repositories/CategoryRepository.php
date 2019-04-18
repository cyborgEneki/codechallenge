<?php

namespace App\Repositories;

use App\Models\Category;
use App\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function allCategories()
    {
        return Category::paginate(10);
    }

    public function createCategory(CategoryRequest $request)
    {
        return Category::create($request->all());
    }

    public function showCategory($id)
    {
        return Category::where('id', '=', $id)->first();        
    }

    public function updateCategory(CategoryRequest $request, Category $category)
    {
        return $category->update($request->all());
    }

    public function deleteCategory(Category $category)
    {
        return $category->delete($category);
    }
}
