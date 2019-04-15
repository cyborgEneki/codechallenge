<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Contracts\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function allBooks()
    {
    }

    public function createBook(Request $request)
    {
    }

    public function showBook(Book $book)
    {
    }

    public function updateBook(Request $request, Book $book)
    {
    }

    public function deleteBook(Book $book)
    {
    }
}
