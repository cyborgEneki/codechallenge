<?php

namespace App\Contracts;

use App\Models\Book;
use Illuminate\Http\Request;

interface BookRepositoryInterface
{
    public function allBooks();

    public function createBook(Request $request);

    public function showBook($id);

    public function updateBook(Request $request, Book $book);

    public function deleteBook(Book $book);
}