<?php

namespace App\Repositories;

use App\Models\Author;
use App\Contracts\AuthorRepositoryInterface;
use App\Http\Requests\AuthorRequest;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function allAuthors()
    {
        return Author::all();
    }

    public function createAuthor(AuthorRequest $request)
    {
        return Author::create($request->all());
    }
    public function showAuthor($id)
    {
        return Author::findOrFail($id);
    }

    public function updateAuthor(AuthorRequest $request, Author $author)
    {
        return $author->update($request->all());
    }

    public function deleteAuthor(Author $author)
    {
        return $author->delete($author);
    }
}
