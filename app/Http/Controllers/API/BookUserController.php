<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookUserRequest;
use App\Models\Book;
use App\Contracts\BookUserRepositoryInterface;
use Illuminate\Http\Request;

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

    public function bookin($bookId, Request $request)
    {
        $bookusers = $this->bookuserRepo->bookin($bookId, $request);
        return $bookusers;
    }
}
