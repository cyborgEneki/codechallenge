<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\BookRepositoryInterface;
use App\Models\Book;

class BookController extends Controller
{
    protected $bookRepo;

    public function __construct(BookRepositoryInterface $bookRepo)
    {
        $this->bookRepo = $bookRepo;
    }

    public function index()
    {
        $book = $this->bookRepo->allBooks();
        return response()->json($book, 200);
    }

    public function store(Request $request)
    {
        $book = $this->bookRepo->createBook($request);
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = $this->bookRepo->showBook($id);
        return response()->json($book, 200);
    }

    public function update(Request $request, Book $book)
    {
        $book = $this->bookRepo->updateBook($request, $book);
        return response()->json($book, 200);
    }

    public function destroy(Book $book)
    {
        $book = $this->bookRepo->deleteBook($book);
        return response()->json($book, 200);
    }
}
