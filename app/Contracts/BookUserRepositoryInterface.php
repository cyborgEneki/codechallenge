<?php

namespace App\Contracts;

use App\Http\Requests\BookUserRequest;
use App\Models\Book;
use Illuminate\Http\Request;

interface BookUserRepositoryInterface
{
    public function index();

    public function borrow(BookUserRequest $request);

    public function return(Book $book, Request $request);
}