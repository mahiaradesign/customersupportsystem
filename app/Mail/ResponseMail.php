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
    public function __construct($data)
    {
        //fetching the content from form to send the mail to the user with query
        $this->response_mail_data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // sender user email ==> mahiara admin email id same email must be entered in the .env file as well
        return $this->from('noreply.mahiara@gmail.com', 'Mahiara')->subject('Response From Mahiara for your Query')->view('mail.response-email',['response_data',$this->response_mail_data]);
    }
}
