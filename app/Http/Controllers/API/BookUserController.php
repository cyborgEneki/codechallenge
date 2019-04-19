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

    public function borrow (BookUserRequest $request)
    {
        $dt = Carbon::today();
        $dtString = $dt->toDateString();

        $dueDate = $dt->addDays(14);
        $dueDateString = $dueDate->toDateString();

        $request["user_id"] = Auth::id();
        $request["due_date"] = $dueDateString;
        $bookuser = BookUser::create($request->all());
        $request["date_out"] = $bookuser->due_date;

        return $bookuser;
    }

    public function return (BookUserRequest $request)
    {
        // $bookuser = BookUser::create($request->all());
        // return $bookuser;
    }

    public function reserve (BookUserRequest $request)
    {
        // $bookuser = BookUser::create($request->all());
        // return $bookuser;
    }
}
