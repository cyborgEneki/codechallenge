<?php

namespace App\Repositories;

use App\Models\BookUser;
use App\Contracts\BookUserRepositoryInterface;
use App\Http\Requests\BookUserRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookAvailable;
use Illuminate\Http\Request;

class BookUserRepository implements BookUserRepositoryInterface
{
    public function index()
    {
        return BookUser::all();
    }

    public function borrow(BookUserRequest $request)
    {
        $holding = BookUser::where('user_id', Auth::id())->where('date_in', null)->get()->count();

        if ($holding < 3) {
            $dt = Carbon::today();
            $dtString = $dt->toDateString();

            $dueDate = $dt->addDays(14);
            $dueDateString = $dueDate->toDateString();
    
            $request["user_id"] = Auth::id();
            $request["due_date"] = $dueDateString;
            $request["date_out"] = $dtString;

            $borrowed = BookUser::select('book_id')->where('book_id', $request['book_id'])->where('due_date', null)->get()->count();

            if ($borrowed == 1) {
                $bookuser = BookUser::create($request->all());
                Book::select('book_id')->where('id', $request['book_id'])->update(['status' => 0]);
                return response()->json($bookuser, 201);
            } else {
                return response()->json(['error' => 'This book has already been borrowed'], 401);
            }
        } else {
            return response()->json(['error'=> 'You have reached the maximum borrowing limit'], 401);
        }
    }
    public function return(Book $book, Request $request)
    {
        $dt = Carbon::today();
        $dtString = $dt->toDateString();

        if ($book->reservor_id !== null) {
            $request["date_in"] = $dtString;
            $book->date_in->update(["date_in" => $dtString]);
            Mail::to($book->reservor()->get()->pluck("email"))->send(new BookAvailable($book));
            Book::select('id')->where('id', $book->id)->update(['reservor_id' => null]);
        }
    }
}
