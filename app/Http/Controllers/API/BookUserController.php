<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookUser;

class BookUserController extends Controller
{
    public function index()
    {
        return BookUser::all();
    }
}
