<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookUserRequest;
use App\Models\Book;
use App\Contracts\BookUserRepositoryInterface;
use Illuminate\Http\Request;
use \PDF;
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

    public function borrow(BookUserRequest $request)
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
        $dt = Carbon::today();
        $dtString = Carbon::today()->toDateString();

        $to = $dt->subDays(7);
        $toString = $to->toDateString();

        $booksborrowed = BookUser::select('date_out')->whereBetween('date_out', [$toString, $dtString])->get()->count();
        $booksreturned = BookUser::select('date_in')->whereBetween('date_in', [$toString, $dtString])->get()->count();
        
        $dt->subDays(3);
        $upperDate = $dt->toDateString();

        $suspendedusers = BookUser::where('date_in', null)->where('due_date', '<', $upperDate)->count();

        $data = ['booksborrowed' => $booksborrowed, 'booksreturned' => $booksreturned, 'suspendedusers' => $suspendedusers];
        $pdf = PDF::loadView('emails.weeklyreport', $data);
  
        return $pdf->download('weeklyreport.pdf');
    }
}
