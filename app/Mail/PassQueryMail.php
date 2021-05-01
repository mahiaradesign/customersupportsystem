<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PassQueryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$se)
    {
        //
        $this->ticket_info = $data;
        $this->se=$se;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME', 'work.mahiara@gmail.com'), 'Mahiara Support')->subject('Allotment of Ticket #'.$this->ticket_info->ticket_id)->view('mail.pass-query-email')->with([
            'exe_name' => $this->se->name,
            'first_name' => $this->ticket_info->first_name,
            'last_name' => $this->ticket_info->last_name,
            'email' => $this->ticket_info->email,
            'mess' => $this->ticket_info->message,
            'ticket_id' => $this->ticket_info->ticket_id,
        ]);
    }
}
