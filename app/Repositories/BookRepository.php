<?php

namespace App\Repositories;

use App\Models\Book;
use App\Contracts\BookRepositoryInterface;
use App\Http\Requests\BookRequest;

class BookRepository implements BookRepositoryInterface
{
    public function allBooks()
    {
        return Book::all();
    }

    public function createBook(BookRequest $request)
    {
        return Book::create($request->all());
    }

    public function showBook($id)
    {
        return Book::findOrFail($id);
    }

    public function updateBook(BookRequest $request, Book $book)
    {
        return $book->update($request->all());
    }

    public function deleteBook(Book $book)
    {
        return $book->delete($book);
    }
}
