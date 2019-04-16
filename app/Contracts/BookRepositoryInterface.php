<?php

namespace App\Contracts;

use App\Models\Book;
use App\Http\Requests\BookRequest;

interface BookRepositoryInterface
{
    public function allBooks();

    public function createBook(BookRequest $request);

    public function showBook($id);

    public function updateBook(BookRequest $request, Book $book);

    public function deleteBook(Book $book);

    public function choices();
}