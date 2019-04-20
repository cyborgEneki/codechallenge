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
    public $booksborrowed;
    public $booksreturned;
    public $suspendedusers;

    public function __construct($booksborrowed, $booksreturned, $suspendedusers)
    {
        $this->booksborrowed = $booksborrowed;
        $this->booksreturned = $booksreturned;
        $this->suspendedusers = $suspendedusers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.weeklyreport');
    }
}
