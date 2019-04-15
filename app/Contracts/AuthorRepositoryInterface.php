<?php

namespace App\Contracts;

use App\Models\Author;
use Illuminate\Http\Request;

interface AuthorRepositoryInterface
{
    public function allAuthors();

    public function createAuthor(Request $request);

    public function showAuthor($id);

    public function updateAuthor(Request $request, Author $author);

    public function deleteAuthor(Author $author);
}