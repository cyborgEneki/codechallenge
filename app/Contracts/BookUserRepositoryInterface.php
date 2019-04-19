<?php

namespace App\Contracts;

use App\Http\Requests\BookUserRequest;
use App\Models\Book;

interface BookUserRepositoryInterface
{
    public function borrow(BookUserRequest $request);

    public function return(Book $book);

    public function index();
}