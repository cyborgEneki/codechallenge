<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\BookUserRequest;

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
    }

    public function reserve(BookUserRequest $request)
    {
        // $bookuser = BookUser::create($request->all());
        // return $bookuser;
    }
}
