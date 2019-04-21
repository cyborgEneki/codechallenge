<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeeklyReportMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $booksBorrowed;
    public $booksReturned;
    public $suspendedUsers;

    public function __construct($booksBorrowed, $booksReturned, $suspendedUsers)
    {
        $this->booksBorrowed = $booksBorrowed;
        $this->booksReturned = $booksReturned;
        $this->suspendedUsers = $suspendedUsers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('weeklyreport');
    }
}
