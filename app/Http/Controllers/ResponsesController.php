<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResponseMail;
use Illuminate\Support\Facades\Mail;
use App\Models\tickets;

class ResponsesController extends Controller
{
    //
    public function reply($id) {
        
        return view('executive.reply')->with(['id'=>$id]);
    }

    public function sendEmail(Request $request, $ticket_id){

        $to_user=tickets::where('ticket_id',$ticket_id)->first();

        // $data=[
        //     'reply_message' =>$request->reply_message,
        // ];

        Mail::to($to_user->email)->send(new ResponseMail($request->reply_message, $ticket_id));
        return "Email Sent to ".$to_user->email;
    }
}
