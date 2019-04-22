<?php

namespace App\Repositories;

use App\Models\Category;
use App\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Models\Book;

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
        $books_with_the_category = Book::where('category_id', $category->id)->get();

        if ($books_with_the_category !== null) {
            return response()->json(['error' => 'Stop! Books are attached to this category'], 404);
        } else {
            return $category->delete($category);
        }
    }
}
