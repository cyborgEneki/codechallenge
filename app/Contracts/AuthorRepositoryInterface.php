<?php

namespace App\Contracts;

use App\Models\Author;
use App\Http\Requests\AuthorRequest;

interface AuthorRepositoryInterface
{
    public function allAuthors();

    public function createAuthor(AuthorRequest $request);

    public function showAuthor($id);

    public function updateAuthor(AuthorRequest $request, Author $author);

    public function deleteAuthor(Author $author);
}