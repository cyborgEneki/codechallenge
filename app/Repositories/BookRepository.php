<?php

namespace App\Repositories;

use App\Models\Book;
use App\Contracts\BookRepositoryInterface;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;
use App\Models\Category;
use App\Models\Department;

class BookRepository implements BookRepositoryInterface
{
    public function allBooks()
    {
        return Book::paginate(10);
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

    public function choices()
    {
        $books = Book::all();
        $books = $books->keyBy('id');
        $books = ['books' => $books];

        $auth_user = ['authuser' => Auth::User()->id];

        $authors = Author::all();
        $authors = $authors->keyBy('id');
        $authors = ['authors' => $authors];        
        
        $categories = Category::all();
        $categories = $categories->keyBy('id');
        $categories = ['categories' => $categories];        
        
        $departments = Department::all();
        $departments = $departments->keyBy('id');
        $departments = ['departments' => $departments];

        return array_merge($books, $auth_user, $authors, $categories, $departments);
    }
}
