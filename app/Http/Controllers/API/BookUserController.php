<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\BookUserRequest;
use App\Models\Book;

class BookUserController extends Controller
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

            $borrowed = BookUser::select('book_id')->where('book_id', $request['book_id'])->where('date_in', null)->get()->count();

            if ($borrowed == 0) {
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

    public function return(BookUserRequest $request)
    {
        // $bookuser = BookUser::create($request->all());
        // return $bookuser;

        // if ($request->exists('status')) {
        //     if ($book->status == 1) {
        //         Mail::to($book->reservor()->get()->pluck("email"))->send(new BookAvailable($book));
        //     }
        // }
    }
}
