<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Contracts\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function allBooks()
    {
        return Book::all();
    }

    public function createBook(Request $request)
    {
        return Book::create($request->all());
    }

    public function showBook($id)
    {
        return Book::findOrFail($id);
    }

    public function updateBook(Request $request, Book $book)
    {
        return $book->update($request->all());
    }

    public function deleteBook(Book $book)
    {
        return $book->delete($book);
    }
}
