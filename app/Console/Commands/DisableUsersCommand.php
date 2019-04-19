<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\DisableUsersMailable;
use Carbon\Carbon;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class DisableUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disable:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable extremely late users';

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
        $dt = Carbon::today();
        
        $firstReminder = $dt->addDays(3);
        $firstReminderString = $firstReminder->toDateString();

        $users = BookUser::select("user_id")->where('date_in', null)->where('due_date', '>' ,$firstReminderString)->get();

        foreach ($users as $user) {
            $name = User::find($user)->pluck("first_name")->first();
            Mail::to(User::find($user)->pluck("email"))->send(new DisableUsersMailable($name));
        }
    }
}
