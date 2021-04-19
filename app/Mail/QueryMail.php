<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->reply_mail_data = $data;
        $this->ticket_id = $data->ticket_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('enter_your_email@gmail.com', 'Mahiara Support')->subject('Ticket #'.$this->ticket_id)->view('mail.reply-email')->with([
            'first_name' => $this->reply_mail_data->first_name,
            'last_name' => $this->reply_mail_data->last_name,
            'email' => $this->reply_mail_data->email,
            'mess' => $this->reply_mail_data->message,
            'ticket_id' => $this->reply_mail_data->ticket_id,
        ]);
    }
}
