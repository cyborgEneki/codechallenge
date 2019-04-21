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
use \PDF;

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

            if ($borrowed !== null) {
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
        //Get today's date
        $dt = Carbon::today();
        $dtString = $dt->toDateString();

        //Get the new due date
        $dueDate = $dt->addDays(14);
        $dueDateString = $dueDate->toDateString();

        //Retrieve the reservor's id
        $reservorId = Book::select('reservor_id')->where('id', $bookId)->first()->reservor_id;

        //Retrieve the returned book
        $book = Book::where('id', $bookId)->first();

        //Update the initial borrower's records
        BookUser::select('book_id')->where("book_id", $bookId)->update(['date_in' => $dtString]);

        if ($reservorId !== null) {
            //Retrieve reservor's name
            $reservor = User::where('id', $reservorId)->get();
            $reservorName = User::where('id', $reservorId)->pluck('first_name')->first();

            //Mail reservor
            Mail::to($reservor->pluck("email"))->send(new BookAvailable($book, $reservorName));

            // Create new book-user pair
            $data = [
                'book_id' => $bookId,
                'user_id' => $reservorId,
                'due_date' => $dueDateString,
                'date_out' => $dtString
            ];
            BookUser::create($data);
            
            //Clear the book's reservation's details
            Book::where('id', $bookId)->update(['reservor_id' => null]);
        }
        return response()->json('success', 200);
    }

    public function weeklyReport()
    {
        $dt = Carbon::today();
        $dtString = Carbon::today()->toDateString();
        $properDt = $dt->format('d-m-Y');

        $to = $dt->subDays(7);
        $toString = $to->toDateString();
        $properTo = $to->format('d-m-Y');

        $booksBorrowed = BookUser::select('date_out')->whereBetween('date_out', [$toString, $dtString])->get()->count();
        $booksReturned = BookUser::select('date_in')->whereBetween('date_in', [$toString, $dtString])->get()->count();
        
        $dt->subDays(3);
        $upperDate = $dt->toDateString();

        $suspendedUsers = BookUser::where('date_in', null)->where('due_date', '<', $upperDate)->count();

        $data = ['booksBorrowed' => $booksBorrowed, 'booksReturned' => $booksReturned, 'suspendedUsers' => $suspendedUsers, 'properDt' => $properDt, 'properTo'=> $properTo];
        
        $pdf = PDF::loadView('weeklyreport', $data);
  
        return $pdf->download($properTo."_to_".$properDt."_weeklyreport.pdf");
    }
}
