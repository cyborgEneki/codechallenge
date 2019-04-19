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
        $borrowed = BookUser::where('user_id', Auth::id())->where('date_in', null)->get()->count();
        if ($borrowed < 3) {
            $dt = Carbon::today();
            $dtString = $dt->toDateString();

            $dueDate = $dt->addDays(14);
            $dueDateString = $dueDate->toDateString();
    
            $request["user_id"] = Auth::id();
            $request["due_date"] = $dueDateString;
            $request["date_out"] = $dtString;
            $bookuser = BookUser::create($request->all());
            return $bookuser;
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
