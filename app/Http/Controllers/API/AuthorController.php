<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\AuthorRepositoryInterface;
use App\Models\Author;

class AuthorController extends Controller
{
    protected $authorRepo;

    public function __construct(AuthorRepositoryInterface $authorRepo)
    {
        $this->authorRepo = $authorRepo;
    }
    public function index()
    {
        $author = $this->authorRepo->allAuthors();
        return response()->json($author, 200);
    }

    public function store(Request $request)
    {
        $author = $this->authorRepo->createAuthor($request);
        return response()->json($author, 201);
    }

    public function show($id)
    {
        $author = $this->authorRepo->showAuthor($id);
        return response()->json($author, 200);
    }

    public function update(Request $request, Author $author)
    {
        $author = $this->authorRepo->updateAuthor($request, $author);
        return response()->json($author, 200);
    }

    public function destroy(Author $author)
    {
        $author = $this->authorRepo->deleteAuthor($author);
        return response()->json($author, 200);
    }
}
