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
use App\Models\User;

class BookUserRepository implements BookUserRepositoryInterface
{
    public function index()
    {
        return BookUser::all();
    }

    public function borrow(Request $request)
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
    public function bookIn($bookId, Request $request)
    {
        $dt = Carbon::today();
        $dtString = $dt->toDateString();

        $reservorId = Book::select('reservor_id')->where('id', $bookId)->first();
        $book = Book::where('id', $bookId)->first();

        BookUser::select('book_id')->where("book_id", $bookId)->update(['date_in' => $dtString]);
        Book::select('id')->where("id", $bookId)->update(['status' => 1]);

        if ($reservorId !== null) {
           $reservor = User::where('id', $reservorId->reservor_id)->get();
           $reservorName = User::where('id', $reservorId->reservor_id)->pluck('first_name')->first();
            Mail::to($reservor->pluck("email"))->send(new BookAvailable($book, $reservorName));
            Book::select('id')->where('id', $bookId)->update(['reservor_id' => null]);
        }
        return response()->json('success', 200);
    }

    public function weeklyReport()
    {
        $dt = Carbon::today();
        $dtString = Carbon::today()->toDateString();

        $to = $dt->subDays(7);
        $toString = $to->toDateString();

        $borrowedNumber = BookUser::select('date_out')->whereBetween('date_out', [$toString, $dtString])->get()->count();
        $returnedNumber = BookUser::select('date_in')->whereBetween('date_in', [$toString, $dtString])->get()->count();

        $dt = Carbon::today();
        
        $dt->subDays(3);
        $upperDate = $dt->toDateString();

        $suspendedNumber = BookUser::where('date_in', null)->where('due_date', '<', $upperDate)->count();
        
        $summary = [$borrowedNumber, $returnedNumber, $suspendedNumber];
        
        return $summary;
    }
}
