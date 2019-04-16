<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\AuthorRepositoryInterface;
use App\Models\Author;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    protected $authorRepo;

    public function __construct(AuthorRepositoryInterface $authorRepo)
    {
        $this->authorRepo = $authorRepo;
    }
    public function index()
    {
        $authors = $this->authorRepo->allAuthors();
        return response()->json($authors, 200);
    }

    public function store(AuthorRequest $request)
    {
        $author = $this->authorRepo->createAuthor($request);
        return response()->json($author, 201);
    }

    public function show($id)
    {
        $author = $this->authorRepo->showAuthor($id);
        return response()->json($author, 200);
    }

    public function update(AuthorRequest $request, Author $author)
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
