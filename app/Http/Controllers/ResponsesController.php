<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResponseMail;
use Illuminate\Support\Facades\Mail;
use App\Models\tickets;

class ResponsesController extends Controller
{
    //

    public function sendEmail($id, Request $request){

        $to_user=tickets::where('ticket_id',$id)->first();

        $data=[
            'message' =>$request->message,
            'exec_user' =>$request->name,
            'exec_email'=>$request->email
        ];

        Mail::to($to_user->email)->send(new ResponseMail($data));
        return "Email Sent to ".$to_user->email;
    }
}
