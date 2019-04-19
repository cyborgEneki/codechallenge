<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\AfterDueDateMailable;
use Carbon\Carbon;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AfterDueDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:postreminder';

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

        $users = BookUser::select("user_id")->where('due_date', '>', $fromString)->get();

        foreach ($users as $user) {
            $name = User::find($user)->pluck("first_name")->first();
            Mail::to(User::find($user)->pluck("email"))->send(new AfterDueDateMailable($name));
        }
    }
}