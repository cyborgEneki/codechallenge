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
    }
    public function showAuthor(Author $author)
    {
    }

    public function updateAuthor(Request $request, Author $author)
    {
    }

    public function deleteAuthor(Author $author)
    {
    }
}
