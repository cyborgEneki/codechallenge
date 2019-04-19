<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\BeforeDueDateMailable;
use App\Models\BookUser;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Book;

class BeforeDueDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:prereminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily reminder to users whose due dates are T-3 days away until the due day reaches';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $from = Carbon::today();
        $fromString = $from->toDateString();
        
        $firstReminder = $from->subDays(3);
        $firstReminderString = $firstReminder->toDateString();

        $users = BookUser::select("user_id")->whereBetween('due_date', [$firstReminderString, $fromString])->get();
        // $dueDate = BookUser::select("due_date")->whereBetween('due_date', [$firstReminderString, $fromString])->get();
        // $books = BookUser::select("book_id")->whereBetween('due_date', [$firstReminderString, $fromString])->get();
        // $dateOut = BookUser::select("date_out")->whereBetween('due_date', [$firstReminderString, $fromString])->get();

        // foreach ($books as $book)
        // {
        //     $title = Book::find($book)->pluck("title")->first();
        // }

        foreach ($users as $user) {
            $name = User::find($user)->pluck("first_name")->first();
            Mail::to(User::find($user)->pluck("email"))->send(new BeforeDueDateMailable($name));
        }
    }
}
