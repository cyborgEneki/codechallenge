<?php

namespace App\Repositories;

use App\Models\Book;
use App\Contracts\BookRepositoryInterface;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;
use App\Models\Category;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class BookRepository implements BookRepositoryInterface
{
    public function allBooks()
    {
        return Book::with(['authors', 'users'])->paginate(10);
    }

    public function createBook(BookRequest $request)
    {
        $book = Book::create($request->all());
        $authors = $request->get('authors');
        $book->authors()->sync($authors);
        return $book;
    }

    public function showBook($id)
    {
        return Book::where('id', '=', $id)->with(['authors', 'users'])->first();
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
        $books = Book::with(['authors', 'users'])->get();
        $books = $books->keyBy('id');
        $books = ['books' => $books];

        $auth_user = ['authuser' => Auth::User()->id];

        $authors = Author::with(['books'])->get();
        $authors = $authors->keyBy('id');
        $authors = ['authors' => $authors];

        $users = User::with(['books'])->get();
        $users = $users->keyBy('id');
        $users = ['users' => $users];

        $authuserstatus = ['authuserstatus'=> Auth::User()->status];
        
        $categories = Category::all();
        $categories = $categories->keyBy('id');
        $categories = ['categories' => $categories];
        
        $departments = Department::all();
        $departments = $departments->keyBy('id');
        $departments = ['departments' => $departments];

        return array_merge($books, $auth_user, $authors, $categories, $departments, $users, $authuserstatus);
    }

    public function reserveBook(Request $request, $bookId)
    {
        $reservor = $request["reservor_id"] = Auth::id();
        $book = Book::find($bookId)->select('reservor_id')->where('reservor_id', null)->first();
        
        if ($book !== null) {
            Book::find($bookId)->update(['reservor_id' => $reservor]);
            return response()->json(['success'=>'Your reservation was successful'], 200);
        } else {
            return response()->json(['error'=>'This book has already been reserved'], 404);
        }
    }

    public function attachAuthors($bookId, $authorId)
    {
        $book = Book::findOrFail($bookId);
        $book->authors()->attach($authorId);
        return $book;
    }
}
