<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryRepo;
    
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $category = $this->categoryRepo->allCategories();
        return response()->json($category, 200);
    }

    public function store(Request $request)
    {
        $category = $this->categoryRepo->createCategory($request);
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->categoryRepo->showCategory($id);
        return response()->json($category, 200);
    }

    public function update(Request $request, Category $category)
    {
        $category = $this->categoryRepo->updateCategory($request, $category);
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        $category = $this->categoryRepo->deleteCategory($category);
        return response()->json($category, 200);
    }
}
