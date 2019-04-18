<?php

namespace App\Repositories;

use App\Models\Author;
use App\Contracts\AuthorRepositoryInterface;
use App\Http\Requests\AuthorRequest;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function allAuthors()
    {
        return Author::with(['books'])->paginate(10);
    }

    public function createAuthor(AuthorRequest $request)
    {
        $author = Author::create($request->all());
        $books = $request->get('books');
        $author->books()->sync($books);
        return $author;
    }
    public function showAuthor($id)
    {
        return Author::where('id', '=', $id)->with(['books'])->first();
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
