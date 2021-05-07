<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class feedback extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        //
        $this->ticket=$ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // sender user email ==> mahiara admin email id same email must be entered in the .env file as well
        return $this->from(env('MAIL_USERNAME', 'work.mahiara@gmail.com'), 'Mahiara Support')->subject('FeedBack For Ticket # '.$this->ticket->ticket_id)->view('mail.feedback')->with('ticket_id',$this->ticket->ticket_id);
    }
}
