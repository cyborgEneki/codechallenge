<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\BookRepositoryInterface;
use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookAvailable;
use Carbon\Carbon;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    protected $bookRepo;

    public function __construct(BookRepositoryInterface $bookRepo)
    {
        $this->bookRepo = $bookRepo;
    }

    public function index()
    {
        $books = $this->bookRepo->allBooks();
        return response()->json($books, 200);
    }

    public function store(BookRequest $request)
    {
        $book = $this->bookRepo->createBook($request);
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = $this->bookRepo->showBook($id);
        return response()->json($book, 200);
    }

    public function update(BookRequest $request, Book $book)
    {
        if ($request->exists('status')) {
            if ($book->status == 1) {
                Mail::to($book->reservor()->get()->pluck("email"))->send(new BookAvailable($book));
            }
        }
        $this->bookRepo->updateBook($request, $book);
        return response()->json($book, 200);
    }

    public function destroy(Book $book)
    {
        $book = $this->bookRepo->deleteBook($book);
        return response()->json($book, 200);
    }

    public function choices()
    {
        $choices = $this->bookRepo->choices();
        return response()->json($choices, 200);
    }

    public function test()
    {
        //
    }
}
