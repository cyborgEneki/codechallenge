<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookUserRequest;
use App\Models\Book;
use App\Contracts\BookUserRepositoryInterface;

class BookUserController extends Controller
{
    protected $bookuserRepo;

    public function __construct(BookUserRepositoryInterface $bookuserRepo)
    {
        $this->bookuserRepo = $bookuserRepo;
    }

    public function index()
    {
        $bookusers = $this->bookuserRepo->index();
        return response()->json($bookusers, 200);
    }

    public function borrow(BookUserRequest $request)
    {
        $bookusers = $this->bookuserRepo->borrow($request);
        return $bookusers;
    }

    public function return(Book $book)
    {
        $bookusers = $this->bookuserRepo->return($book);
        return $bookusers;
    }
}
