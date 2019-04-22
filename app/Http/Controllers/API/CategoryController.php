<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Validator;
use App\Http\Requests\CategoryRequest;
use App\Models\Book;

class CategoryController extends Controller
{
    protected $categoryRepo;
    
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->allCategories();
        return response()->json($categories, 200);
    }

    public function store(CategoryRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $category = $this->categoryRepo->createCategory($request);
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->categoryRepo->showCategory($id);
        return response()->json($category, 200);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category = $this->categoryRepo->updateCategory($request, $category);
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        $category = $this->categoryRepo->deleteCategory($category);
        return $category;
    }
}