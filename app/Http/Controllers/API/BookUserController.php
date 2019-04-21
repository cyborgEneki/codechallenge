<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\BookUserRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BookUser;

class BookUserController extends Controller
{
    protected $bookuserRepo;

    public function __construct(BookUserRepositoryInterface $bookuserRepo)
    {
        $this->bookuserRepo = $bookuserRepo;
    }

    public function index()
    {
        $bookusers = $this->bookuserRepo->index();
        return response()->json($bookusers, 200);
    }

    public function borrow(Request $request)
    {
        $bookusers = $this->bookuserRepo->borrow($request);
        return $bookusers;
    }

    public function bookIn($bookId, Request $request)
    {
        $bookusers = $this->bookuserRepo->bookIn($bookId, $request);
        return $bookusers;
    }

    public function weeklyReport()
    {
        $weeklyreport = $this->bookuserRepo->weeklyReport();
        return $weeklyreport;
    }
}
