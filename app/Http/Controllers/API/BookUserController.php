<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\BookUser;

class BookUserController extends Controller
{
    public function index () 
    {
        return BookUser::all();
    }
}
