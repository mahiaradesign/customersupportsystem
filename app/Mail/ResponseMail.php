<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $id)
    {
        //fetching the content from form to send the mail to the user with query
        $this->mess = $data;
        $this->ticket_id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // sender user email ==> mahiara admin email id same email must be entered in the .env file as well
        return $this->from('enter_your_email@gmail.com', 'Mahiara Support')->subject('Ticket #'.$this->ticket_id)->view('mail.response-email')->with('mess',$this->mess);
    }
}
