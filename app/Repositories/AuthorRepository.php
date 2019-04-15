<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Contracts\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function allAuthors()
    {
        return Author::all();
    }

    public function createAuthor(Request $request)
    {
        return Author::create($request->all());
    }
    public function showAuthor($id)
    {
        return Author::findOrFail($id);
    }

    public function updateAuthor(Request $request, Author $author)
    {
        return $author->update($request->all());
    }

    public function deleteAuthor(Author $author)
    {
        return $author->delete($author);
    }
}
