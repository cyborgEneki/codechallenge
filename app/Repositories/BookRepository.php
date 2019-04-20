<?php

namespace App\Repositories;

use App\Models\Book;
use App\Contracts\BookRepositoryInterface;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class BookRepository implements BookRepositoryInterface
{
    public function allBooks()
    {
        return Book::with(['users'])->paginate(10);
    }

    public function createBook(BookRequest $request)
    {
        return Book::create($request->all());
    }

    public function showBook($id)
    {
        return Book::where('id', '=', $id)->first();
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
        $books = Book::with(['users'])->get();
        $books = $books->keyBy('id');
        $books = ['books' => $books];

        $auth_user = ['authuser' => Auth::User()->id];

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

        return array_merge($books, $auth_user, $categories, $departments, $users, $authuserstatus);
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
}
